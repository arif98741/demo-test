<?php

namespace App\Http\Controllers\Admin;
use Image;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
// use Intervention\Image\ImageManager as Image;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }
    public function add(){
        return view('admin.category.add');
    }
    public function insert(Request $request){
        $validation = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',     
            'meta_description' => 'required',
            'image' => 'required', 
            
        ]);
        $category = new Category();
       
     
        if($request->has('image')){
            $photoname = Str::random(32).".".$request->image->getClientOriginalExtension();
            Image::make($request->image)->resize(600,400)->save('assets/uploads/category/'.$photoname);
            $category->image = $photoname;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular') == TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');
        $category->save();
        return redirect('/dashboard')->with('status','Category Added Successfully');
    }
    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request,$id){
        $category = Category::find($id);
        $validation = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',     
            'meta_description' => 'required',  
        ]);
        if($request->hasFile('image')){
           $path = 'assets/uploads/category/'.$category->image;
           if(File::exists($path)){
            File::delete($path);
           }
           $photoname = Str::random(32).".".$request->image->getClientOriginalExtension();
            Image::make($request->image)->resize(600,400)->save('assets/uploads/category/'.$photoname);
            $category->image = $photoname;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular') == TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');
        $category->update();
        return redirect('/dashboard')->with('status','Category Updated Successfully');
    }
    public function destroy($id){
        $category = Category::find($id);
        if($category->image){
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('/categories')->with('status','Category deleted Successfully');
    }
}
    