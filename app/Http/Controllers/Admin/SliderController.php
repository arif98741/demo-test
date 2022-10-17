<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
class SliderController extends Controller
{
   public function index(){
        $slider = Slider::all();
        return view('admin.slider.index',compact('slider'));
    }
    //add slider
   public function addSlider(){
        return view('admin.slider.addslider');
    }
    //store data
   public function store(Request $request){
       $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'image' => 'required',
       ]);
       $slider = new Slider();
       $slider->title = $request->title;
       $slider->description = $request->description;
       if($request->has('image')){
        $photoname = Str::random(32).".".$request->image->getClientOriginalExtension();
        Image::make($request->image)->resize(1100,400)->save('assets/uploads/slider/'.$photoname);
        $slider->image = $photoname;
        }
        $slider->save();
        return redirect('/slider')->with('status','Slider added');
    }
    //edit
    public function edit($id){
        $editslider = Slider::find($id);
        return view('admin.slider.edit',compact('editslider'));
    }
    //update
    public function update(Request $request,$id){
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
           ]);
         $updateSlider = Slider::find($id);
         $updateSlider->title = $request->title;
         $updateSlider->description = $request->description;
         if($request->has('image')){
            $path = 'assets/uploads/slider/'.$updateSlider->image;
            if(File::exists($path)){
             File::delete($path);
            }
            $photoname = Str::random(32).".".$request->image->getClientOriginalExtension();
             Image::make($request->image)->resize(1100,400)->save('assets/uploads/slider/'.$photoname);
             $updateSlider->image = $photoname;
         }
         $updateSlider->update();
         return redirect('/slider')->with('status','Slider Updated ');
    }
    //delete
   public function delete($id){
        $slider = Slider::find($id);
        if($slider->image){
            $path = 'assets/uploads/slider/'.$slider->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $slider->delete();
        return redirect('/slider')->with('status','Slider Deleted');
    }
}
