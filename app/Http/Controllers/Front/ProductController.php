<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;

class ProductController extends Controller
{
    public function getProductBySlug($slug)
    {
        $product = Page::whereSlug($slug)->firstOrFail();

        return view('front.product', compact('product'));
    }
}
