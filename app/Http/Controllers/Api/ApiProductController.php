<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    public function index(Request $request)
    {
        // Lấy giá trị từ yêu cầu POST
        $searchValue = $request->input('input');
        // Kiểm tra xem giá trị tìm kiếm có tồn tại hay không
        if ($searchValue) {
            // Thực hiện tìm kiếm trong cơ sở dữ liệu
            $products = Product::where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('description', 'like', '%' . $searchValue . '%')
                ->get();

            // Trả về kết quả tìm kiếm
            return response()->json(['products' => $products], 200);
        }

        // Nếu không có giá trị tìm kiếm, có thể trả về tất cả sản phẩm hoặc thông báo lỗi tùy ý
        return response()->json(['message' => 'No search value provided.'], 400);
    }
}
