<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout','API\Auth\LoginController@logout');

    Route::post('/signup', 'API\Member\AdmissionController@SignUp')->name('SignUp');
    Route::get('/admission/pending_approvals', 'API\Member\AdmissionController@Pending')->name('PendingApprovals');
    Route::post('/admission/application', 'API\Member\AdmissionController@ShowApplication')->name('ShowApplication');
    Route::post('/admission/application_status', 'API\Member\AdmissionController@ApplicationStatus')->name('ApplicationStatus');
    Route::post('/signature_upload', 'API\Member\AdmissionController@addSignature')->name('SignatureUpload');
    Route::get('/office_bearer', 'API\Administration\OfficeBearerController@index')->name('ShowOfficeBearer');
    Route::post('/office_bearer', 'API\Administration\OfficeBearerController@update')->name('UpdateOfficeBearer');
    Route::post('/member', 'API\Member\MemberDetails@View')->name('ViewMember');
    Route::get('/profile', 'API\Member\MemberDetails@profile')->name('profile');
    Route::post('/edit/profile', 'API\Member\MemberDetails@profileEdit')->name('ProfileEdit');
    Route::post('/edit/nominee', 'API\Member\MemberDetails@nomineeEdit')->name('NomineeEdit');
    Route::post('/edit/bank', 'API\Member\MemberDetails@bankEdit')->name('BankEdit');
    Route::post('/edit/nominee_bank', 'API\Member\MemberDetails@nomineeBankEdit')->name('NomineeBankEdit');
    Route::get('/member_details', 'API\Member\MemberDetails@memberDetails')->name('MemberDetails');
    Route::post('/member_details/edit', 'API\Member\MemberDetails@Edit')->name('EditMember');
    Route::post('/ecs_by_month', 'API\Administration\ECSController@ECSByMonth')->name('ECSByMonth');
    Route::post('/ecs_by_member', 'API\Administration\ECSController@ECSByMember')->name('ECSByMember');
    Route::post('/membership_details', 'API\Administration\MembershipController@MembershipDetails')->name('MembershipDetails');
    Route::post('/membership/verify', 'API\Administration\MembershipController@MembershipVerify')->name('MembershipVerify');
    Route::post('/membership/collection_view', 'API\Administration\MembershipController@LHMembershipCollectionView')->name('LHMembershipCollectionView');
    Route::post('/membership/collection', 'API\Administration\MembershipController@LHMembershipCollection')->name('LHMembershipCollection');
    Route::post('/membership/pay', 'API\Administration\MembershipController@pay_membership')->name('PayMembership');
});
Route::post('login','API\Auth\LoginController@login');
