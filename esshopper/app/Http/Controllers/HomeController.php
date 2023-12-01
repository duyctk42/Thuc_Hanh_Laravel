<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index(){
      $sliders = Slider::latest()->get();
      $categorys = Category::where('paren_id', 0)->get();
      $products = Product::latest()->take(6)->get();
      $productsRecommend = Product::latest('view_count', 'desc')->take(12)->get();
      $categorysLimid = Category::where('paren_id', 0)->take(3)->get();
      return view('home.home',compact('sliders', 'categorys','products','productsRecommend','categorysLimid'));
  }
    public function test(){
        return view('test');
    }
}
