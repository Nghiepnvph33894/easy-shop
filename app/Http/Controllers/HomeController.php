<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home()
    {
        $productData = Product::latest('id')->limit(5)->get();
        $categoryData = Category::pluck('name', 'id')->all();

        return view('client.index', compact('productData', 'categoryData'));
    }
}
