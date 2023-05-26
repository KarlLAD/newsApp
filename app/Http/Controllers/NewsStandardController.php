<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsStandardController extends Controller
{
    //
    public function index($id=0)
    {
// si $id diffrérent de 0 on liste tout
        if ($id != 0) {
// Afficher les news par id
            $actus = News::where('category_id' , $id)->orderBy('created_at' , 'desc')->get();
        } else {

// Afficher toutes les news limiter à 8    (10)

            $actus = News::orderBy('created_at' , 'desc')->paginate(8) ;
        }



        $categories = Category::orderBy('name' , 'asc')->get();

        return view('news.standard' , compact('actus' , 'categories')) ;
    }

    public function detail(News $actu)

    {
        return view('news.standardDetail' , compact('actu'));

    }
}
