<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
public function index() {

   $actus = News::all() ; // tout lister
   //$actus = News::orderBy('created_at' , 'desc')->paginate(10)  ;

    return view("usernews.liste" , compact ('actus'));
        }
}
