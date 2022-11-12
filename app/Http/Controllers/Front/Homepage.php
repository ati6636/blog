<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Configs;
use Facade\FlareClient\View;
use Validator;
use Mail;

class Homepage extends Controller
{
    public function __construct(){
      if (Configs::find(1)->active==0) {
        return redirect()->to('site-bakimda')->send();
      }
      view()->share('pages',Page::where('status',1)->orderBy('order','ASC')->get());
      view()->share('categories',Category::where('status',1)->inRandomOrder()->get());
      view()->share('config',Configs::find(1));
    }

    public function index(){
        $data['articles'] = Article::with('getCategory')->where('status',1)->whereHas('getCategory',function($query){
          $query->where('status',1);
        })->orderBy('created_at','DESC')->paginate(2);
        $data['articles']->withPath(url('sayfa'));
        return view('front.homepage',$data);
    }

    public function single($category,$slug){
        $category = Category::whereSlug($category)->first() ?? abort(403,'Böyle Bir Kategori Bulunamadı');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Böyle Bir Yazı Bulunamadı');
        $article->increment('hit');
        $data['article'] = $article;
        return view('front.single',$data);
    }

    public function category($slug){
        $category = Category::whereSlug($slug)->first() ?? abort(403,'Böyle Bir Kategori Bulunamadı');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id',$category->id)->where('status',1)->orderBy('created_at','DESC')->paginate(1);
        return view('front.category', $data);
    }

    public function page($slug){
      $page = Page::whereSlug($slug)->first() ?? abort(403,'Böyle Bir Sayfa Bulunamadı');
      $data['page'] = $page;
      return view('front.page',$data);
    }

    public function contact(){
      return view('front.contact');
    }

    public function contactpost(Request $request){
      $rules = [
        'name' => 'required|min:5',
        'email' => 'required|email',
        'topic' => 'required',
        'message' => 'required|min:10',
      ];
      $validate = Validator::make($request->post(),$rules);

      if($validate->fails()){
        return redirect()->route('contact')->withErrors($validate)->withInput();
      }

      //Mail Gönderme İşlemleri İçin Kullanılan Kod Sistemi
      Mail::send([],[],function($message) use($request){
        $message->from('iletisim@mfcopy.com','MfpCopy');
        $message->to('sedatislek66@gmail.com');
        $message->setBody('Mesajı Gönderen :'.$request->name.'<br />
                  Mesajı Gönderen Mail : '.$request->email.'<br />
                  Mesaj Konusu         :  '.$request->topic.'<br />
                  Mesaj : '.$request->message.'<br /><br />
                  Mesaj Gönderilme Tarihi : '.now().'','text/html');
        $message->subject($request->name. ' İletişimden mesaj gönderildi.');
      });

      /*$contact = new Contact;
      $contact->name=$request->name;
      $contact->email=$request->email;
      $contact->topic=$request->topic;
      $contact->message=$request->message;
      $contact->save();*/
      return redirect()->route('contact')->with('success','Mesajınız Bize İletildi. Teşekkür Ederiz.');
    }

}
