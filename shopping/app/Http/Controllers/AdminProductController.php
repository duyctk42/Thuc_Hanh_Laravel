<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Rucusive;
use App\Http\Requests\ProductAddRequest;
use App\ProductImage;
use App\Product;
use App\ProductTag;
use App\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use http\Env\Response;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Storage;
use DB;

class AdminProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;

    private $category;
    private $Product;
    private $ProductImage;
    private $tag;
    private $productTag;

    public function __construct(Category $category, Product $Product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->Product = $Product;
        $this->ProductImage = $productImage;
        $this->tag = $tag;
        $this->ProductTag = $productTag;
    }

    public function index()
    {
        $products = $this->Product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parenId = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function getCategory($parenId)
    {
        $data = $this->category->all();
        $recusive = new Rucusive($data);
        $htmlOption = $recusive->categoryRecusive($parenId);
        return $htmlOption;
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id

            ];
            $dataUploadFeatureImage = $this->StorageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->Product->create($dataProductCreate);
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->StorageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([

                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);

                }
            }
            $tagIds = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }

            }
            $product->tags()->attach($tagIds);

            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message :' . $exception->getMessage() . 'line:' . $exception->getLine());
        }


    }

    public function edit($id)
    {
        $product = $this->Product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id

            ];
            $dataUploadFeatureImage = $this->StorageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->Product->find($id)->update($dataProductUpdate);
            $product = $this->Product->find($id);
            if ($request->hasFile('image_path')) {
                $this->ProductImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->StorageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([

                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);

                }
            }
            $tagIds = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }

            }
            $product->tags()->sync($tagIds);

            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message :' . $exception->getMessage() . 'line:' . $exception->getLine());

        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->Product);
    }
}
