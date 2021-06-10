<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\{Article};
use Illuminate\Http\Request;
use Mail;
use View;

class FrontController extends Controller {


    public function home(){     
      return redirect()->route('articles');
    }

    public function articles() {
      $articles = Article::published()->get();
      return view('pages.articles', compact('articles'));
    }

    public function article($slug) {
      $article = Article::where('slug', $slug)->first();
      // set_seo($article);
      return view('pages.article', compact('article'));
    }

    

   
}
