<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function menu()
    {
        $menu = Category::with('products')->get();
        return view('menu', \compact('menu'));
    }
}
