<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    // Home Page
    public function index()
    {
        $products = Product::latest('created_at')->paginate(10);

        return view('front.index', compact('products'));
    }

}
