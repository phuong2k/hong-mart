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

        if ($request->hasfile('image')) {
            $get_file = $request->file('image')->store('images/products');
            $product_data['image'] = $get_file;
        }
        if($product_data['count'] === null || $product_data['count'] === 0) {
            $product_data['status'] = 1;
        }
        if($product_data['count'] !== null && $product_data['count'] !== 0) {
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
        if ($request->hasfile('image')) {
            if($product->image != null){
                Storage::delete($product->image);
            }
            $get_file = $request->file('image')->store('images/products');
            $product_data['image'] = $get_file;
        }
        if($product_data['count'] === null || $product_data['count'] === 0) {
            $product_data['status'] = 1;
        }
        if($product_data['count'] !== null && $product_data['count'] !== 0) {
            $product_data['status'] = 0;
        }
        $product_data['slug'] = Str::slug($product_data['name']);
        $product->update($product_data);

        return to_route('admin.product.index')->with('message', 'Thêm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != null) {
            Storage::delete($product->image);
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
            ->paginate(10);;
        // Return the search view with the resluts
        return view('admin.product.search', compact('products'));
    }
}
