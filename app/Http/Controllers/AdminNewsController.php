<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminNewsController extends Controller
{


    // méthode pour lister
    public function index()
    {
    //    $actus =  News::all() ;  // lister tout
       
        $actus =  News::orderBy('created_at' , 'desc')->paginate(10) ;  // lister tout par ordre décroissant

        return view("adminnews.liste" , compact('actus'));

    }
    // Ajoute dans mon formulaire
    public function formAdd(){ 
        
        $categories = Category::orderBy('name' , 'asc')->get() ;

        return view('adminnews.edit' , compact('categories'));
    }

    // édition dans le formulaire
    public function formEdit($id = 0){ // Affiche dans mon formulaire

        $actu = News::findOrFail($id) ;
        // classer les catégories par ordre croissant
        $categories = Category::orderBy('name' , 'asc')->get() ;
        //$actu->titre = $request->titre ;
        return view('adminnews.edit' , compact('actu' ,
                                                'categories') );
  
                                                
    }


//créer instance du modele à modifier à partir de l'id pour en registrer en base
    public function edit(Request $request , $id=0){

        $actu = News::findOrFail($id) ;
        $request->validate(['titre' => 'required|min:5']) ;

        $actu->titre = $request->titre ;
        $actu->category_id = $request->category ;
        $actu->save() ; // Enregistrement des données
        if ($request->image) {

            if ($actu->image) {
                $fileName = $request->image->store('public/images') ;
                $actu->image = $fileName ;
            }

        }

    }

// Ajouter des info

    public function add (Request $request){ 

        //dd($request->titre) ;
// Vérification des données du formulaire
/**
* titre obligatoire
*/

$newsModel = new News ; // Création d'une instance de classe (model News ) pour enrehgistrer en base

$request->validate(['titre' => 'required|min:5']) ;

//Gestion de l'upload de l'image

if ($request->file()) 
    {
        // nom du fichier d'enregistrement
       // $fileName = $request->image->store('images') ;
//école pédagogique
        $fileName = $request->image->store('public/images') ;
        $newsModel->image = $fileName ;
    
// $news->titre="first news" ;
       $newsModel->titre = $request->titre ;
       $newsModel->save() ; // Enregistrement des données
    }

// description

        $newsModel->description = $request->description ;
        $newsModel->save() ; // Enregistrement des données

//categorie
        $newsModel->category_id = $request->category ;
        return redirect(route('news.add')) ;

    }
 
// Suppression de f'information
public  function delete($id= 0){

    /*retourne message erreur */
    $actu = News::findOrFail($id) ;
    Storage::delete($actu->image);

if ($actu->image != ''){
    Storage::delete($actu->image);
}


    $actu->delete() ; // Pour supprimer item dans une db
    //récupération a partir de son idenifiant
    dd($id) ;

    return 'delete' ;
    }




}

