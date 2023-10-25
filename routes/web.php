<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Wp\Page\Temp;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\SightingController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Wp\Home;
use App\Http\Controllers\Wp\Page;
use App\Http\Controllers\Wp\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/foobar', function () {
//    return view('wp.home');
//});


Route::get('/dashboards', function () {
    // return view('sightingPrompt');
    return view('dashboard');
})->name("dashboard");

// Route::get('language/{lang?}', function (Request $request) {
//     if (in_array($request->lang, config("app.available_locales"))) {
//         app()->setLocale(strtolower($request->lang));
//         session()->put('locale', strtolower($request->lang));
//     }
//     return redirect()->route("index");
// })->name("changeLanguage");

Route::group(['middleware' => ['auth', 'isAdmin']], function () { //
    Route::get("/sichtungen/list", [SightingController::class, 'index'])->name("sichtungen");
    // nutzers routes for your application.
    Route::resource("nutzer", UserController::class);
});

Route::group(['middleware' => ['auth']], function () { //'auth',

    Route::get('/tags', [TagController::class, 'index'])->name("tags.index");
    Route::post('/tags/store', [TagController::class, 'store'])->name("tags.store");
    Route::get('/tags/{code}', [TagController::class, 'edit'])->name("tags.new");
    Route::get('/tags/delete/{id}', [TagController::class, 'delete'])->name("tags.delete");
});

Route::group(['middleware' => ['authAware']], function () {
    // Route::get('/sighting/{id}', [SightingController::class, 'add']);
    Route::get("/sichtungen", [SightingController::class, 'enter'])->name("sichtungen.prompt");
    Route::post('/sichtungen/store', [SightingController::class, 'store'])->name("sichtungen.store");
    Route::post('/sichtungen/redir', [SightingController::class, 'redir'])->name("sichtungen.redir");
    Route::get('/sichtungen/{id}', [SightingController::class, 'add'])->name("sichtungen.view");
    Route::get('/activate/{id}', [ActivationController::class, 'index'])->name("activation.view");
    Route::post('/activate/{id}', [ActivationController::class, 'store'])->name("activation.send");
    Route::get('/download/{id}', [ActivationController::class, 'downloadSVG'])->name("activation.download");
    Route::get('', [Home::class, 'index'])->name("shop");


    Route::get('feedback/{id}', [FeedbackController::class, 'index'])->name("feedback");
    Route::post('feedback', [FeedbackController::class, 'send'])->name("feedback.send");
    // need to explicitly mention those:
    Route::get('/wp-login.php')->name("login");
    Route::get('/wp-login.php?action=logout', [FrontEndController::class, "index"])->name("logout");
    Route::get('/my-account/lost-password/', [FrontEndController::class, "index"])->name("index");
    Route::get('/register/{code}', [SightingController::class, "add"])->name("index");
});
