<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Validator;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function index(){
        $data['articles']=Article::orderByDesc('created_at')->paginate(2);
       $data['categories']= Category::all();
       $data['pages']=Page::orderBy('order')->get();
       return view('front.homepage', $data);

    }

    public function single($id){
        $article=Article::where('id',$id)->first() ?? abort(404);
        $article->increment('hit');
        $data['article']=$article;
        $data['pages']=Page::orderBy('order')->get();
        $data['categories']= Category::all();

        return view('front.single',$data);

    }

    public function category($id){
        $category=Category::where('id',$id)->first() ?? abort(404);
        $data['category']=$category;
        $data['articles']=Article::where('category_id',$category->id)->orderByDesc('created_at')->paginate(1);
        $data['pages']=Page::orderBy('order')->get();
        $data['categories']= Category::all();

        return view('front.category',$data);
    }

    public function page($slug){

        $page=Page::where('slug',$slug)->first() ?? abort('404');
        $data['page']=$page;
        $data['pages']=Page::orderBy('order')->get();
        return view('front.page',$data);
    }

    public function contact(){
        $data['pages']=Page::orderBy('order')->get();
        return view('front.contact',$data);
    }

    public function contactpost(Request $request){
        $rules=[
            'name'=>'required|min:5',
            'email'=>'required|email',
            'phone'=>'required|numeric',
            'message'=>'required|min:10'
        ];

            $validate=Validator::make($request->post(),$rules);
            if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }


        $contact = new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->phone=$request->phone;
        $contact->message=$request->message;
        $contact->save();
        return redirect()->route('contact')->with('success','Mesajınız başarıyla iletildi.');
    }
}
