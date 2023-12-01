<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Traits\SlugCreater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Google\Service\Drive;
class ProductController extends Controller
{
    use SlugCreater;

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(15);

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product_data = $request->safe()->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images/products', 'google');

            // Lấy URL của ảnh vừa lưu
            $url = Storage::disk('google')->url($path);

            // Gán URL vào dữ liệu sản phẩm
            $product_data['image'] = $url;
            Storage::delete('images/products/' . $file->getClientOriginalName());
        }
        if ($product_data['count'] === null || $product_data['count'] === 0) {
            $product_data['status'] = 1;
        }
        if ($product_data['count'] !== null && $product_data['count'] !== 0) {
            $product_data['status'] = 0;
        }
        $product_data['slug'] = Str::slug($product_data['name']);
        $product = Product::create($product_data);

        return to_route('admin.product.index')->with('message', trans('admin.product_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product_data = $request->safe()->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images/products', 'google');

            // Lấy URL của ảnh vừa lưu
            $url = Storage::disk('google')->url($path);

            // Gán URL vào dữ liệu sản phẩm
            $product_data['image'] = $url;
            Storage::delete('images/products/' . $file->getClientOriginalName());
        }
        if ($product_data['count'] === null || $product_data['count'] === 0) {
            $product_data['status'] = 1;
        }
        if ($product_data['count'] !== null && $product_data['count'] !== 0) {
            $product_data['status'] = 0;
        }
        $product_data['slug'] = Str::slug($product_data['name']);
        $product->update($product_data);

        return to_route('admin.product.index')->with('message', 'Thêm thành công');
    }
    // Function to delete a file by its file ID
    function deleteFile($service, $fileId)
    {   
        try {
            $service->files->delete($fileId);
            return true;
        } catch (Exception $e) {
            // Handle any errors that occurred during the request.
            return false;
        }
    }

    // Function to get Google Drive file ID from URL
    function getFileIdFromUrl($url)
    {
        // Extract file ID from URL
        preg_match('/\/d\/([^\/]+)/', $url, $matches);
        if (isset($matches[1])) {
            return $matches[1];
        }

        return null;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Get the file ID from the Google Drive URL stored in the 'image' field
        $fileId = $this->getFileIdFromUrl($product->image);
        // If file ID is found, attempt to delete the file from Google Drive
        if ($fileId) {
            $client = new Google\Client();
            $client->setAuthConfig([
                'web' => [
                    'client_id' => env('GOOGLE_CLIENT_ID'),
                    'project_id' => env('GOOGLE_PROJECT_ID'),
                    'auth_uri' => env('GOOGLE_AUTH_URI'),
                    'token_uri' => env('GOOGLE_TOKEN_URI'),
                    'auth_provider_x509_cert_url' => env('GOOGLE_AUTH_PROVIDER_X509_CERT_URL'),
                    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
                    'redirect_uris' => [env('GOOGLE_REDIRECT_URIS')],
                ],
            ]);
            $client->addScope(Google\Service\Drive::DRIVE);
            // Create Drive service
            $service = new Google\Service\Drive($client);
            // Delete the file
            if (!deleteFile($service, $fileId)) {
                // If successful, also delete the local record of the image
                return false;
            }else{
                return true;
            }
        }

        $product->delete();

        return back()->with('message', 'Xóa thành công');
    }

    public function getSlug(Request $request)
    {
        $slug = $this->createSlug($request, Product::class);

        return response()->json(['slug' => $slug]);
    }

    public function search(Request $request)
    {
        $searched_text = $request->input('search');

        $products = Product::where('name', 'LIKE', "%{$searched_text}%")
            ->orWhere('description', 'LIKE', "%{$searched_text}%")
            ->paginate(10);
        ;
        // Return the search view with the resluts
        return view('admin.product.search', compact('products'));
    }
}
