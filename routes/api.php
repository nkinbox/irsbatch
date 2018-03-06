<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout','API\Auth\LoginController@logout');

    Route::post('/signup', 'API\Member\AdmissionController@SignUp')->name('SignUp');
    Route::get('/admission/pending_approvals', 'API\Member\AdmissionController@Pending')->name('PendingApprovals');
    Route::post('/admission/application', 'API\Member\AdmissionController@ShowApplication')->name('ShowApplication');
    Route::post('/admission/application_status', 'API\Member\AdmissionController@ApplicationStatus')->name('ApplicationStatus');
    Route::post('/signature_upload', 'API\Member\AdmissionController@addSignature')->name('SignatureUpload');
});
Route::post('login','API\Auth\LoginController@login');
