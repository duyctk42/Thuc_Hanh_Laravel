<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function  index($slug, $categoryId){
      $categorysLimid = Category::where('paren_id', 0)->take(3)->get();
      $products = Product::where('category_id', $categoryId)->paginate(12);
      $categorys = Category::where('paren_id', 0)->get();
     return view('product.category.list', compact('categorysLimid','products', 'categorys'));
  }
}
