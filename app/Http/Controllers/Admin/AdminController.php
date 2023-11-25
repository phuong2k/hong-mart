<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $products = Product::count();
        $news_letter_users = User::where('news_letter', true)->count();

        return view('admin.index', compact('products', 'users', 'news_letter_users'));
    }
}
