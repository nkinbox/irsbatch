<?php
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    //Route::get('/dashboard', 'MemberController@SignUpForm')->name('dashboard');
    Route::get('/signup', 'Member\AdmissionController@SignUpForm')->name('SignUpForm');
    Route::post('/signup', 'Member\AdmissionController@SignUp')->name('SignUp');
    Route::get('/admission/pending_approvals', 'Member\AdmissionController@Pending')->name('PendingApprovals');
    Route::get('/admission/application/{id}', 'Member\AdmissionController@ShowApplication')->name('ShowApplication');
    Route::post('/admission/application_status', 'Member\AdmissionController@ApplicationStatus')->name('ApplicationStatus');
    Route::post('/signature_upload', 'Member\AdmissionController@addSignature')->name('SignatureUpload');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('/login');
});
