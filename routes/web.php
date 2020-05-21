<?php
use App\Mail\Mailer;

// use codedge\Fpdf\Facades\Fpdf;
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

// Route::get('/', function () {
//     return view('pages/index');
// });
Route::get('/','PagesController@index');    
Route::get('/index', 'PagesController@index');
Route::get('/about', 'PagesController@about');


//creating a dynamic route
Route::get('/users/{id}',function($id){
    return 'This is user '.$id;
});
Route::get('/users/{id}/{name}',function($id, $name){
    return 'This is user '.$name.' with an ID '.$id;
});
Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/home', 'HomeController@index')->name('dashboard');


//EVENT ROUTES
Route::get('events/{id}/register','EventsController@registerForm');
Route::delete('events/{id}/cancelRegisteration','EventsController@cancelRegisteration');
Route::put('events/{id}/uploadRegister','EventsController@uploadRegister');
Route::get('events/{id}/viewRegister','EventsController@viewRegister');
Route::resource('events','EventsController');
// Route::resource('events','EventsRegisterController');

// Route::get('events/{id}/register','EventsController@register');

//EXAM ARCHIVES
Route::get('/exams/level1.php', 'ExamsController@level1');
Route::get('/exams/level2.php', 'ExamsController@level2');
Route::get('/exams/level3.php', 'ExamsController@level3');
Route::get('/exams/level4.php', 'ExamsController@level4');
Route::get('/exams/level5.php', 'ExamsController@level5');
Route::get('/exams/level1.php/{level}', 'ExamsController@uploadExam');
Route::get('/exams/level2.php/{level}', 'ExamsController@uploadExam');
Route::get('/exams/level3.php/{level}', 'ExamsController@uploadExam');
Route::get('/exams/level4.php/{level}', 'ExamsController@uploadExam');
Route::get('/exams/level5.php/{level}', 'ExamsController@uploadExam');
Route::delete('/exams/level1.php/{id}', 'ExamsController@destroy');
Route::delete('/exams/level2.php/{id}', 'ExamsController@destroy');
Route::delete('/exams/level3.php/{id}', 'ExamsController@destroy');
Route::delete('/exams/level4.php/{id}', 'ExamsController@destroy');
Route::delete('/exams/level5.php/{id}', 'ExamsController@destroy');
// Route::resource('exams','ExamsController');

//LECTURE ARCHIVES
Route::get('/lectures/level1.php', 'LecturesController@level1');
Route::get('/lectures/level2.php', 'LecturesController@level2');
Route::get('/lectures/level3.php', 'LecturesController@level3');
Route::get('/lectures/level4.php', 'LecturesController@level4');
Route::get('/lectures/level5.php', 'LecturesController@level5');
Route::get('/lectures/level1.php/{level}', 'LecturesController@uploadLecture');
Route::get('/lectures/level2.php/{level}', 'LecturesController@uploadLecture');
Route::get('/lectures/level3.php/{level}', 'LecturesController@uploadLecture');
Route::get('/lectures/level4.php/{level}', 'LecturesController@uploadLecture');
Route::get('/lectures/level5.php/{level}', 'LecturesController@uploadLecture');
Route::delete('/lectures/level1.php/{id}', 'LecturesController@destroy');
Route::delete('/lectures/level2.php/{id}', 'LecturesController@destroy');
Route::delete('/lectures/level3.php/{id}', 'LecturesController@destroy');
Route::delete('/lectures/level4.php/{id}', 'LecturesController@destroy');
Route::delete('/lectures/level5.php/{id}', 'LecturesController@destroy');

//FPDF
// Route::get('pdf', function(Codedge\Fpdf\Fpdf\Fpdf $fpdf){
//     $fpdf = new Fpdf();
//     $fpdf->AddPage();
//     $fpdf->SetFont('Arial','B',16);
//     $fpdf->Cell(40,10,'Hello World!');
//     $fpdf->Output();
//     exit;
// });

//CALCULATORS
Route::get('/calculators/electronics',function(){
    return view('calculators/electronics/resistor');
});

// // DOMPDF
// Route::get('invoice', function(){
//     $pdf = PDF::loadView('invoice');
//     return $pdf->download('invoice.pdf');
// });
// // FDPF
// Route::get('/fpdf', function () {

//     Fpdf::AddPage();
//     Fpdf::SetFont('Courier', 'B', 18);
//     Fpdf::Cell(50, 25, 'Hello World!');
//     Fpdf::Output('storage/exam_images/test.pdf','F');
// });

//ADMIN DASHBOARD
// Route::get('user/create','UsersController@create')
Route::get('view-users','UsersController@index')->middleware('isAdmin');
Route::get('export-users-pdf','UsersController@exportUsersPDF')->middleware('isAdmin');
Route::resource('users','UsersController')->middleware('isAdmin');

//MAILER
// Route::get('/email', function(){
//     Mail::to("mohamed.elmanzalawy98@gmail.com")->send(new Mailer());

//     return new Mailer();
// });