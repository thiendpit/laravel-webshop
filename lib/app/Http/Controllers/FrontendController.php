<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function getHome()
    {
        $data['featured'] = Product::where('prod_featured', 1)->orderBy('prod_id', 'desc')->take(8)->get();
        $data['categories'] = Category::all();
        $data['news'] = Product::orderBy('prod_id', 'desc')->take(8)->get();
        return view('frontend.home', $data);
    }
}
