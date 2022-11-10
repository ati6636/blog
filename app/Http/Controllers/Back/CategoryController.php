<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
      $categories = Category::all();
      return view('back.category.index', compact('categories'));
    }

    public function create(Request $request){
      $isExist = Category::whereSlug(Str::slug($request->category))->first();
      if($isExist){
        toastr()->error($request->category.' Adında Bir Kategori Bulunmaktadır:', 'HATA!');
        return redirect()->back();
      }
      $category = new Category;
      $category->name = $request->category;
      $category->slug = Str::slug($request->category);
      $category->save();
      toastr()->success('Başarılı Şekilde Oluşturuldu.','Kategori');
      return redirect()->back();
    }


      public function update(Request $request){
        $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName = Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName){
          toastr()->error($request->category.' Adında Bir Kategori Bulunmaktadır:', 'HATA!');
          return redirect()->back();
        }
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->slug);
        $category->save();
        toastr()->success('Başarılı Şekilde Güncellendi.','Kategori');
        return redirect()->back();
      }

    public function getData(Request $request){
      $category = Category::findOrFail($request->id);
      return \Response::json($category);

    }

    public function switch(Request $request){
      $category = Category::findOrFail($request->id);
      $category->status = $request->statu=="true" ? 1 : 0 ;
      $category->save();
    }
}
