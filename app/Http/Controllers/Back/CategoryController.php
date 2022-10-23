<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('back.categories.index',compact('categories'));
    }

    public function create(Request $request){
        $isExist=Category::whereSlug(Str::slug($request->category))->first();
        if ($isExist){
            toastr()->error('',$request->category. ' adında bir kategori zaten mevcut');
            return redirect()->back();
        }
    $category = new Category;
    $category->name = $request->category;
    $category->slug = Str::slug($request->category);
    $category->save();
    toastr()->success('','Kategori Başarıyla Eklendi');
    return redirect()->back();
    }


    public function update(Request $request){
        $isExistName=Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if ($isExistName){
            toastr()->error('',$request->category. ' adında bir kategori zaten mevcut');
            return redirect()->back();
        }

        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->save();
        toastr()->success('Yeni bir düzenleme yapmak için sayfayı yenileyiniz.','Kategori başarıyla düzenlendi.');
        return redirect()->back();
    }

    public function delete(Request $request){
        $category=Category::findOrFail($request->id);
        if($category->id ==1 ){
        toastr()->error('','Bu kategori silinemez');
        return redirect()->back();
        }
        $count=$category->articleCount();
        if($count>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
        }
        $category->delete();
        toastr()->error('','Kategori başarıyla silindi ');
        return redirect()->back();
    }

    public function getData(Request $request){
        $category=Category::findOrFail($request->id);
        return response()->json($category);
    }
}
