<?php
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    //Route::get('/dashboard', 'MemberController@SignUpForm')->name('dashboard');
    Route::get('/mode/{mode}', 'SwitchMode@index')->name('SwitchMode');
    Route::get('/signup', 'Member\AdmissionController@SignUpForm')->name('SignUpForm');
    Route::post('/signup', 'Member\AdmissionController@SignUp')->name('SignUp');
    Route::get('/admission/pending_approvals', 'Member\AdmissionController@Pending')->name('PendingApprovals');
    Route::get('/admission/application/{id}', 'Member\AdmissionController@ShowApplication')->name('ShowApplication');
    Route::post('/admission/application_status', 'Member\AdmissionController@ApplicationStatus')->name('ApplicationStatus');
    Route::post('/signature_upload', 'Member\AdmissionController@addSignature')->name('SignatureUpload');
    Route::get('/office_bearer', 'Administration\OfficeBearerController@index')->name('ShowOfficeBearer');
    Route::post('/office_bearer', 'Administration\OfficeBearerController@update')->name('UpdateOfficeBearer');
    Route::get('/member/{id}', 'Member\MemberDetails@view')->name('ViewMember');
    Route::get('/profile', 'Member\MemberDetails@profile')->name('profile');
    Route::get('/edit/profile', 'Member\MemberDetails@profileEditForm')->name('ProfileEditForm');
    Route::post('/edit/profile', 'Member\MemberDetails@profileEdit')->name('ProfileEdit');
    Route::get('/edit/nominee', 'Member\MemberDetails@nomineeEditForm')->name('NomineeEditForm');
    Route::post('/edit/nominee', 'Member\MemberDetails@nomineeEdit')->name('NomineeEdit');
    Route::get('/edit/bank', 'Member\MemberDetails@bankEditForm')->name('BankEditForm');
    Route::post('/edit/bank', 'Member\MemberDetails@bankEdit')->name('BankEdit');
    Route::get('/edit/nominee_bank', 'Member\MemberDetails@nomineeBankEditForm')->name('NomineeBankEditForm');
    Route::post('/edit/nominee_bank', 'Member\MemberDetails@nomineeBankEdit')->name('NomineeBankEdit');
    Route::get('/member_details', 'Member\MemberDetails@memberDetails')->name('MemberDetails');
    Route::get('/member_details/view/{id}', 'Member\MemberDetails@View')->name('ViewMember');
    Route::get('/member_details/edit/{id}', 'Member\MemberDetails@EditForm')->name('EditMemberForm');
    Route::post('/member_details/edit', 'Member\MemberDetails@Edit')->name('EditMember');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('/login');
});
