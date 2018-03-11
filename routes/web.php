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
    //Route::get('/member/{id}', 'Member\MemberDetails@View')->name('ViewMember');
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
    Route::get('/upload_ecs', 'Administration\ECSController@uploadFilesForm')->name('UploadEcsForm');
    Route::post('/upload_ecs', 'Administration\ECSController@uploadFiles')->name('UploadEcs');
    Route::get('/process_ecs/{step?}', 'Administration\ECSController@processECS')->name('Process_ECS');
    //Route::get('/process_ecs/view', 'Administration\ECSController@FinalizeECS')->name('Finalize_ECS');
    Route::delete('/process_ecs', 'Administration\ECSController@processECS_delete')->name('Process_ECS_delete');
    Route::put('/process_ecs', 'Administration\ECSController@processECS_put')->name('Process_ECS_put');
    //Route::put('/insert_ecs', 'Administration\ECSController@InsertECS')->name('InsertECSFile');
    Route::get('/ecs_tracking', 'Administration\ECSController@ECSTrackingView')->name('ECSTracking');
    Route::get('/ecs_tracking/{id}/{membership_code?}', 'Administration\ECSController@ECS2MemberForm')->name('ECS2MemberForm');
    Route::post('/ecs_tracking', 'Administration\ECSController@ECS2Member')->name('ECS2Member');
    Route::post('/ecs_ignore', 'Administration\ECSController@IgnoreECS')->name('IgnoreECS');
    Route::post('/ecs_membership_fees', 'Administration\ECSController@membership_fees')->name('MarkAsMembershipFees');
    //Route::post('/ecs_loan_repayment', 'Administration\ECSController@loan_repayment')->name('MarkAsLoanRepayment');
    Route::get('/ecs_by_month', 'Administration\ECSController@ECSByMonth')->name('ECSByMonth');
    Route::post('/ecs_by_month', 'Administration\ECSController@ECSByMonth')->name('ECSByMonth');
    Route::get('/ecs_by_member', 'Administration\ECSController@ECSByMember')->name('ECSByMember');
    Route::post('/ecs_by_member', 'Administration\ECSController@ECSByMember')->name('ECSByMember');
    Route::get('/ecs_form', 'Administration\ECSController@ECSForm')->name('ECSForm');
    Route::get('/membership_details', 'Administration\MembershipController@MembershipDetails')->name('MembershipDetails');
    Route::post('/membership_details', 'Administration\MembershipController@MembershipDetails')->name('MembershipDetails');
    Route::post('/membership/verify', 'Administration\MembershipController@MembershipVerify')->name('MembershipVerify');
    Route::get('/membership/collection', 'Administration\MembershipController@LHMembershipCollectionForm')->name('LHMembershipCollectionForm');
    Route::get('/membership/collection_view', 'Administration\MembershipController@LHMembershipCollectionView')->name('LHMembershipCollectionView');
    Route::post('/membership/collection_view', 'Administration\MembershipController@LHMembershipCollectionView')->name('LHMembershipCollectionView');
    Route::post('/membership/collection', 'Administration\MembershipController@LHMembershipCollection')->name('LHMembershipCollection');
    Route::get('/membership/pay', 'Administration\MembershipController@pay_membership_form')->name('PayMembershipForm');
    Route::post('/membership/pay', 'Administration\MembershipController@pay_membership')->name('PayMembership');



    Route::get('/cancel', 'Member\AdmissionController@Cancel')->name('MembershipCancellation');
    Route::post('/cancel', 'Member\AdmissionController@Cancel')->name('MembershipCancellation');
    Route::get('/cancellation/view', 'Member\AdmissionController@CancellationList')->name('CancellationList');
    Route::post('/cancellation', 'Member\AdmissionController@CancellationStatus')->name('CancellationStatus');
    Route::get('/grievance', 'Administration\GrievanceController@all')->name('Grievance');
    Route::get('/grievance_member', 'Administration\GrievanceController@addView')->name('GrievanceMember');
    Route::post('/grievance_member', 'Administration\GrievanceController@add')->name('GrievanceMember');
    Route::get('/grievance/view/{id}', 'Administration\GrievanceController@show')->name('GrievanceShow');
    Route::post('/grievance', 'Administration\GrievanceController@action')->name('GrievanceAction');
    Route::get('/help_list', 'Administration\HelpController@HelpList')->name('HelpList');
    Route::get('/help', 'Administration\HelpController@getHelpForm')->name('GetHelp');
    Route::post('/help', 'Administration\HelpController@getHelp')->name('GetHelp');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return redirect('/login');
});