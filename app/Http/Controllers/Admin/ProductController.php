<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }
    public function add(){
        $category = Category::all();
        return view('admin.product.add',compact('category'));
    }
    public function insert(Request $request){
        $validated = $request->validate([
                'cate_id' =>'required',
                'name' =>'required',
                'slug' =>'required',
                'small_description' =>'required',
                'description' =>'required',
                'original_price' =>'required',
                'selling_price' =>'required',
                'image' =>'required',
                'tax' =>'required',
                'qty' =>'required',
                'meta_title'  =>'required',
                'meta_keywords' =>'required',
                'meta_description' =>'required',
        ]);
        $product = new Product();

        if($request->has('image')){
            $photoname = Str::random(32).".".$request->image->getClientOriginalExtension();
            Image::make($request->image)->resize(600,400)->save('assets/uploads/products/'.$photoname);
            $product->image = $photoname;
        }
        $product->cate_id = $request->input('cate_id');
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->tax = $request->input('tax');
        $product->qty = $request->input('qty');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_description = $request->input('meta_description');
        $product->save();
        return redirect('/products')->with('status','Prduct Added Successfully');
    }
    public function edit($id){
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.product.edit',['product'=>$product,'category'=>$category]);
    }
    public function update(Request $request,$id){
        $product = Product::find($id);
        $validated = $request->validate([
            'cate_id' =>'required',
            'name' =>'required',
            'slug' =>'required',
            'small_description' =>'required',
            'description' =>'required',
            'original_price' =>'required',
            'selling_price' =>'required',
            'tax' =>'required',
            'qty' =>'required',
            'meta_title'  =>'required',
            'meta_keywords' =>'required',
            'meta_description' =>'required',
    ]);
    if($request->has('image')){
        $path = 'assets/uploads/products/'.$product->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $photoname = Str::random(32).".".$request->image->getClientOriginalExtension();
        Image::make($request->image)->resize(600,400)->save('assets/uploads/products/'.$photoname);
        $product->image = $photoname;
    }
    $product->cate_id = $request->input('cate_id');
    $product->name = $request->input('name');
    $product->slug = $request->input('slug');
    $product->small_description = $request->input('small_description');
    $product->description = $request->input('description');
    $product->original_price = $request->input('original_price');
    $product->selling_price = $request->input('selling_price');
    $product->tax = $request->input('tax');
    $product->qty = $request->input('qty');
    $product->status = $request->input('status') == TRUE ? '1':'0';
    $product->trending = $request->input('trending') == TRUE ? '1':'0';
    $product->meta_title = $request->input('meta_title');
    $product->meta_keywords = $request->input('meta_keywords');
    $product->meta_description = $request->input('meta_description');
    $product->update();
    return redirect('/products')->with('status','Product Updated Successfully');
    }
    public function destroy($id){
        $product = Product::find($id);
        $path = 'assets/uploads/products/'.$product->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $product->delete();
        return redirect('/products')->with('status','Product Deleted Succesfully');
    }
}
