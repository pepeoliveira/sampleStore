<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        // random order inRandomOrder()->get();
        $productsAll = Product::inRandomOrder()->get();

        // ORDEM ASCENDENTE
        $productsAll = Product::get();

        // ORDEM DESCENDENTE
        $productsAll = Product::orderBy('price','DESC')->get();

        // CATEGORIAS E SUB-CATEGORIAS
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        // BANNERS ENABLED
        $banners = Banner::where('status','1')->get();

        return view ('index',['productsAll'=>$productsAll,'categories'=>$categories, 'banners'=>$banners]);

    }
}
