<?php

use Illuminate\Support\Facades\Route;

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
// mail

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

Route::post('/api/mail', 'UserController@forgetPass');

// Route::get('/api/mail', function(){
//     $newpass = randomPassword();
//     $user = DB::table('users')->select('email', 'firstName')->where('email', 'user@gmail.com')->first();
        
//     if($user){
//         $randPass = randomPassword();

//         $email = 'ubec.creative@gmail.com';

//         $body = "Hi $user->firstName, <br/>
//         Here's your new password ".$randPass;
        

//         try {
//             Mail::to($email)->send(new \App\Mail\FormMail($body, 'Forget Password'));
//         } catch (\Throwable $th) {
//         }
        
//     }

//     // $email = 'ubec.creative@gmail.com';
//     // $body = "Your password has been reset please use ".$newpass;
//     // try {
//     //     Mail::to($email)->send(new \App\Mail\FormMail($body, 'Forget Password'));
//     // } catch (\Throwable $th) {
//     // }
// });

// register user 
Route::post('/new-user', 'UserController@register');

// home page
Route::get('/', function () {
    return view('home');
})->name('home');

// get timeline by id
Route::get('/timeline/{docId?}', 'TimelineController@viewTimeline');
Route::post('/timeline/{docId?}', 'TimelineController@viewTimeline');

// reset pass
Route::post('/reset-pass', 'UserController@resetPass');

// attachment
Route::post('/file/add-file', 'DocumentController@addAttachment');


Route::group(['middleware' => 'prevent-back-history'], function(){
    Route::get('/login', 'UserController@login')->name('login');
    Route::get('/logout', 'UserController@logout');
    Route::post('/login', 'UserController@authLogin');

    Route::group(['middleware' => 'authusers'], function () {

        Route::get('/admin', function () {
            return view('admin');
        })->name('admin');

        // DOCS
        Route::get('/docs', 'DocumentController@docsView');
        Route::post('/docs', 'DocumentController@submitDocs');
        Route::get('/docs-tracknum/{tracknum?}', 'DocumentController@trackNum');
        Route::get('/docs-res', 'DocumentController@getReceiverDocs');
        Route::post('/docs-confirmed', 'DocumentController@confirmDocs');
        Route::post('/docs-forwarded', 'DocumentController@forwardDocs');


        // USERS
        Route::get('/get-users', 'UserController@getUsers');
        Route::post('/get-users', 'UserController@getUserId');
        Route::post('/save-users', 'UserController@register');
        Route::post('/update-users', 'UserController@updateUser');
        Route::post('/change-pass', 'UserController@changePass');

        // DEPARTMENT
        Route::get('/get-department', 'DepartmentController@getDepartments');
        Route::post('/get-department', 'DepartmentController@getDepartmentId');
        Route::post('/save-department', 'DepartmentController@addDepartment');
        Route::post('/update-department', 'DepartmentController@updateDepartment');
    });
    
});
