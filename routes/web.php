<?php

use App\Http\Controllers\AdminNewsController;
use App\Http\Controllers\NewsStandardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});

// route non sécurisé

//   return view('user');
//Route::get('/news' ,[NewsController::class , 'index'])->name('news.liste');

/****  affichage des news pour le client*/

Route::get('/newsstandard' ,[NewsStandardController::class , 'index'])->name('news.standard');

Route::get('/newsstandard/category/{id}' ,[NewsStandardController::class , 'index'])->name('news.standard.category');

Route::get('/newsstandard/{actu}' ,[NewsStandardController::class , 'detail'])->name('news.standard.detail');

/**     fin affichage des news pour le client*/

// securité de la route via le middleware
Route::get('/secure', function () {
    return view('secure');

})->middleware(['auth']);


//
Route::get('/notsecure', function () {
    return view('notsecure');

});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
/** Route sécurisé pour la gestion des News */
/*  'can:admin' interdir si autre admin */
Route::middleware(['auth' , 'can:admin'])->group(function () {

    // ajouter
    Route::get('admin/news/add' ,[AdminNewsController::class , 'formAdd'])->name('news.add');
// interdire un élément
//    Route::get('admin/news/add' ,[AdminNewsController::class , 'formAdd'])->can('admin')->name('news.add');
    Route::post('admin/news/add' ,[AdminNewsController::class , 'add'])->name('news.add');

// afficher et modifier le formulaire sur serveur
    Route::get('admin/news/edit/{id}' ,[AdminNewsController::class , 'formEdit'])->name('news.edit');
    Route::post('admin/news/edit/{id}' ,[AdminNewsController::class , 'edit'])->name('news.edit');

    // on liste le formulaire
    Route::get('admin/news/liste' ,[AdminNewsController::class , 'index'])->name('news.liste');
    // supprimer
    //Route::get('admin/news/delete/{id}' ,[AdminNewsController::class , 'delete'])->name('news.delete');


     //la méthode reçois l identifiant (delete/{id})
    Route::get('admin/news/delete/{id}' ,[AdminNewsController::class , 'delete'])->name('news.delete');


});

require __DIR__.'/auth.php';
