<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Instruction;
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
//Admin panel
Route::group(['middleware' => ['auth', 'isadmin'], 'prefix' => 'admin', 'as' => 'admin.'], function()
{
    Route::get('/manage','HomeController@manageInstructions')->name('manage');
    Route::get('/instructions/{instruction}/downloadAdmin','InstructionsController@DownloadAdmin');
    Route::get('/instructions/{id}/state','InstructionsController@State')->name('instructions.state');
    Route::get('/instructions/{id}/delete','InstructionsController@Destroy')->name('instructions.destroy');

});


Route::get('/','InstructionsController@Index');
Route::get('/instructions/create','InstructionsController@Create')->middleware('auth');
Route::get('/instructions/{instruction}','InstructionsController@Show')->middleware('approve');
Route::get('/instructions/{instruction}/download','InstructionsController@Download')->middleware('approve');


Auth::routes();


Route::post('/search',function(){
    $q = request('query');
    $instructions = Instruction::where('is_approved',1)->where('title','LIKE','%'.$q.'%')->orderBy('id','DESC')->get();
    if(count($instructions) > 0){
        return view('home',compact('instructions'));
    }
    else{
        return redirect('/');
    }

});

Route::post('/report','ReportsController@Store');
Route::post('/instruction','InstructionsController@Store');
