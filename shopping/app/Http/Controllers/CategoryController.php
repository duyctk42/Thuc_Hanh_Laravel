<?php

namespace App\Http\Controllers;

use App\Category;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use App\Components\Rucusive;

class CategoryController extends Controller
{
    use deleteModelTrait;
    private $category;

    public function __construct(Category $category){

        $this->category =$category;
    }
    public function create()
    {

            $htmlOption =$this->getCategory($parenId ='');
            return view('admin.category.add', compact('htmlOption'));

    }


    public function index()
    {
        $categories = $this->category->latest()->paginate(5);

         return view('admin.category.index', compact('categories'));

    }
    public function store(Request $request){
        $this->category->create([
            'name'=>$request->name,
            'paren_id' =>$request->paren_id,
            'slug' =>str_slug($request->name)

        ]);
        return redirect() -> route('categories.index');
    }
    public function  getCategory($parenId){
        $data = $this->category->all();
        $recusive = new Rucusive($data);
        $htmlOption = $recusive->categoryRecusive($parenId);
        return $htmlOption;
    }
    public function edit($id) {
        $category = $this->category->find($id);
        $htmlOption =$this->getCategory($category->paren_id);
        return view('admin.category.edit',compact('category', 'htmlOption'));

    }
    public function update($id, Request $request) {
        $this->category->find($id)->update([
            'name'=>$request->name,
            'paren_id' =>$request->paren_id,
            'slug' =>str_slug($request->name)

        ]);
        return redirect() -> route('categories.index');
    }
    public function delete($id) {
        return $this->deleteModelTrait($id, $this->category);
    }
}
