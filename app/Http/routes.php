<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/***************************************************************************************
*
* Create roles
* (Run only once)
*/

Route::get('create/roles', function () {
    $user = new \App\Role();
    $user->name         = 'candidate';
    $user->display_name = 'Candidate'; // optional
    $user->description  = 'User is a job seeking candidate'; // optional
    $user->save();

    $user = new \App\Role();
    $user->name         = 'employer';
    $user->display_name = 'Employer'; // optional
    $user->description  = 'User is offering job(s) and can post jobs'; // optional
    $user->save();

    $su = new \App\Role();
    $su->name         = 'su';
    $su->display_name = 'Root Administrator'; // optional
    $su->description  = 'User is Root and allowed to manage and edit all aspects of the application'; // optional
    $su->save();

    $moderator = new \App\Role();
    $moderator->name         = 'moderator';
    $moderator->display_name = 'Moderator'; // optional
    $moderator->description  = 'User is allowed to manage and edit jobs'; // optional
    $moderator->save();

    $admin = new \App\Role();
    $admin->name         = 'admin';
    $admin->display_name = 'Administrator'; // optional
    $admin->description  = 'User is allowed to manage and edit users'; // optional
    $admin->save();

    return "COMPLETED. TRY NEXT ROUTE -><b>create/permissions</b>";
});

Route::get('create/role/employer', function () {
    $su = new \App\Role();
    $su->name         = 'employer';
    $su->display_name = 'Employer'; // optional
    $su->description  = 'User is offering job(s) and can post jobs'; // optional
    $su->save();
    echo "Created employer role";
    echo PHP_EOL."NEXT : create/permission/employer";
});


Route::get('create/permissions', function () {
    $restrictesaccess = new \App\Permission();
    $restrictesaccess->name         = 'restricted-access';
    $restrictesaccess->display_name = 'Restricted Access'; // optional
    $restrictesaccess->description  = 'User has restricted access'; // optional
    $restrictesaccess->save();

    $limitedaccess = new \App\Permission();
    $limitedaccess->name         = 'limited-access';
    $limitedaccess->display_name = 'Limited Access'; // optional
    $limitedaccess->description  = 'User has access to limited sections'; // optional
    $limitedaccess->save();

    $completeaccess = new \App\Permission();
    $completeaccess->name         = 'complete-access';
    $completeaccess->display_name = 'Complete Access'; // optional
    $completeaccess->description  = 'User can access all sections'; // optional
    $completeaccess->save();

    $su = new \App\Permission();
    $su->name         = 'root-access';
    $su->display_name = 'Root Access'; // optional
    $su->description  = 'Super User'; // optional
    $su->save();

    return "COMPLETED. Basic roles and perms setup. Do <b>set/attachpermissions</b> next.";
});

Route::get('create/permission/employer', function () {
    $su = new \App\Permission();
    $su->name         = 'employer-access';
    $su->display_name = 'Employer Access'; // optional
    $su->description  = 'Employer'; // optional
    $su->save();
    echo "Created employer permission";
    echo PHP_EOL."NEXT : set/attachpermission/employer";
});

Route::get('set/attachpermissions', function () {
    $userrole = \App\Role::where('name', 'candidate')->first();
    $userperm = \App\Permission::where('name', 'restricted-access')->first();
    $userrole->perms()->sync(array($userperm->id));

    $employerrole = \App\Role::where('name', 'employer')->first();
    $employerperm = \App\Permission::where('name', 'limited-access')->first();
    $employerrole->attachPermission($employerperm);
    $employerrole->perms()->sync(array($employerperm->id));

    $moderatorrole = \App\Role::where('name', 'moderator')->first();
    $moderatorperm = \App\Permission::where('name', 'limited-access')->first();
    $moderatorrole->attachPermission($moderatorperm);
    $moderatorrole->perms()->sync(array($moderatorperm->id));

    $adminrole = \App\Role::where('name', 'admin')->first();
    $adminperm = \App\Permission::where('name', 'complete-access')->first();
    $adminrole->attachPermission($adminperm);
    $adminrole->perms()->sync(array($adminperm->id));

    $surole = \App\Role::where('name', 'su')->first();
    $superm = \App\Permission::where('name', 'root-access')->first();
    $surole->perms()->sync(array($superm->id));

    return "COMPLETED.!!!!!!!!!!!";
});

Route::get('set/attachpermission/employer', function () {
    $employerrole = \App\Role::where('name', 'employer')->first();
    $employerperm = \App\Permission::where('name', 'employer-access')->first();
    $employerrole->perms()->sync(array($employerperm->id));
    echo PHP_EOL."COMPLETED !!!";
});

Route::get('set/su/{id}', function ($id) {
    $user = \App\User::find($id);
    $role = \App\Role::where('name', 'su')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as SU";
});

Route::get('set/admin/{id}', function ($id) {
    $user = \App\User::find($id);
    $role = \App\Role::where('name', 'admin')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as admin";
});

Route::get('set/moderator/{id}', function ($id) {
    $user = \App\User::find($id);
    $role = \App\Role::where('name', 'moderator')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as moderator";
});

Route::get('set/employer/{id}', function ($id) {
    $user = \App\User::find($id);
    $role = \App\Role::where('name', 'employer')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as employer";
});

Route::get('set/candidate/{id}', function ($id) {
    $user = \App\User::find($id);
    $role = \App\Role::where('name', 'candidate')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as candidate";
});

Route::get('set/only/su/{id}', function ($id) {
    $user = \App\User::find($id);
    $user->detachRoles($user->roles);
    echo "Removing roles from {$id}";
    $role = \App\Role::where('name', 'su')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as SU";
});

Route::get('set/only/admin/{id}', function ($id) {
    $user = \App\User::find($id);
    $user->detachRoles($user->roles);
    echo "Removing roles from {$id}";
    $role = \App\Role::where('name', 'admin')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as admin";
});

Route::get('set/only/moderator/{id}', function ($id) {
    $user = \App\User::find($id);
    $user->detachRoles($user->roles);
    echo "Removing roles from {$id}";
    $role = \App\Role::where('name', 'moderator')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as moderator";
});

Route::get('set/only/employer/{id}', function ($id) {
    $user = \App\User::find($id);
    $user->detachRoles($user->roles);
    echo "Removing roles from {$id}";
    $role = \App\Role::where('name', 'employer')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as employer";
});

Route::get('set/only/candidate/{id}', function ($id) {
    $user = \App\User::find($id);
    $user->detachRoles($user->roles);
    echo "Removing roles from {$id}";
    $role = \App\Role::where('name', 'candidate')->first();

    $user->roles()->attach($role->id);
    echo "Setting {$id} as candidate";
});

/*=======================================================================================*/

Route::get('pass', function () {
    return Hash::make('Polar@123');
});

Route::get('time', function () {
    return date('Y-m-d H:i:s', strtotime('2016-01'));
});

Route::get('email/template/confirm', function () {
    return view('emails.confirmregistration')->with('link', URL::route('Home'));
});


Route::get('email/template/forgot', function () {
    return view('emails.forgotpassword')->with('username', 'desertjinn')
                                        ->with('useremail', 'rohit.suseelan@costrategix.com')
                                        ->with('password', 'Polar@123');
});

function readCSV($csvFile)
{
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle)) {
        $line_of_text[] = fgetcsv($file_handle, 1024);
    }
    fclose($file_handle);
    return $line_of_text;
}
Route::get('parsecsv/{name?}', function ($filename = null) {
    if ($filename) {
        $csvFile = public_path().'/csv/'.$filename;
        $csv = readCSV($csvFile);
        $out = '';
        echo '<pre>';
        foreach ($csv as $c) {
            $countrycode = mb_convert_encoding(
                $c[0],
                "UTF-8",
                mb_detect_encoding($c[0], "UTF-8, ISO-8859-1, ISO-8859-15", true)
            );

            $statename = mb_convert_encoding(
                $c[2],
                "UTF-8",
                mb_detect_encoding($c[2], "UTF-8, ISO-8859-1, ISO-8859-15", true)
            );

            $stateslug = mb_convert_encoding(
                $c[2],
                "UTF-8",
                mb_detect_encoding($c[2], "UTF-8, ISO-8859-1, ISO-8859-15", true)
            );

            $out .= "[\"country_id\" => \""
                    .$countrycode
                    ."\", \"state\" => \""
                    .$statename
                    ."\", \"slug\" => \""
                    .str_slug($stateslug)
                    ."\"], <br>";
        }
        //echo html_entity_decode($out,  ENT_COMPAT,  'UTF-8');
        //echo mb_convert_encoding(
        //      $out,
        //      "UTF-8",
        //      mb_detect_encoding($out, "UTF-8, ISO-8859-1, ISO-8859-15", true)
        //  );
        echo $out;
        echo '</pre>';
    } else {
        return "No FILE specified";
    }
});

/***************************************************************************************
*
* Login Routes
*/
Route::group(['middleware'=>'auth.notloggedin'], function () {
    //GET Show login page
    Route::get('show/login', ['as'=>'ShowLogin', 'uses'=>'Client\LoginController@showLogin']);

    //GET Show login page with error - **WARNING:NOT BEING USED**
    Route::get('show/login/error', ['as'=>'ShowLoginWithError', 'uses'=>'Client\LoginController@showLoginWithError']);

    //GET Show google login page
    Route::get('show/login/google', ['as'=>'ShowGoogleLogin', 'uses'=>'Client\LoginController@redirectToGoogle']);

    //ANY handle google login
    Route::get(
        'login/oauth2callback',
        ['as'=>'HandleGoogleLogin', 'uses'=>'Client\LoginController@handleGoogleCallback']
    );

    //GET Show linkedin login page
    Route::get(
        'show/login/linkedin',
        ['as'=>'ShowLinkedInLogin', 'uses'=>'Client\LoginController@redirectToLinkedIn']
    );

    //ANY handle linkedin login
    Route::get(
        'login/linkedincallback',
        ['as'=>'HandleLinkedInLogin', 'uses'=>'Client\LoginController@handleLinkedInCallback']
    );

    //POST Execute login action
    Route::post('login', ['as'=>'Login', 'uses'=>'Client\LoginController@doLogin']);

    //GET Forgot password page
    Route::get('forgot/password', ['as'=>'ForgotPassword',  'uses'=>'Client\LoginController@showForgotPassword']);

    //POST Reset forgotten password
    Route::post(
        'forgot/password/reset',
        ['as'=>'ResetForgottenPassword',  'uses'=>'Client\LoginController@resetForgotPassword']
    );
});

//Route::group(['middleware'=>'auth.loggedin'], function () {
//    //GET Execute log out action
//    Route::get('logout', ['as'=>'Logout', 'uses'=>'Client\LoginController@doLogout']);
//    Route::get('employer/logout', ['as'=>'LogoutEmployer', 'uses'=>'Client\LoginController@doEmployerLogout']);
//});

//GET Execute user log out action
Route::get('logout', ['as'=>'Logout', 'uses'=>'Client\LoginController@doLogout']);

/*=======================================================================================*/


/***************************************************************************************
*
* Registration Routes
*/

//GET Registration page
Route::get('register', ['as'=>'Register', 'uses'=>'Client\RegisterController@showRegister']);

//AJAX load registration form
Route::post(
    'register/async/loadregisterform',
    ['as'=>'LoadRegisterForm', 'uses'=>'Client\RegisterController@loadRegisterForm']
);

//AJAX load state list - @param int country_id
Route::post('register/async/loadstatelist/{id?}', ['as'=>'LoadStateList', 'uses'=>'Client\RegisterController@loadStateList']);

//AJAX load company list - @param int company_id (to preselect previously selected SELECT box value)
Route::post(
    'register/async/loadcompanylist/{selectcompany?}',
    ['as'=>'LoadCompanyList', 'uses'=>'Client\RegisterController@loadCompanyList']
);

//POST Do User Registration action
Route::any('registerclient', ['as'=>'RegisterClient', 'uses'=>'Client\RegisterController@doRegister']);

//POST Do New Company Registration action
Route::post('registercompany', ['as'=>'RegisterCompany', 'uses'=>'Client\RegisterController@doRegisterCompany']);

//GET Confirm Registration
Route::get(
    'register/confirm/{email}/{code}',
    ['as'=>'ConfirmRegistration', 'uses'=>'Client\RegisterController@confirmRegister']
);

//AJAX load Employers registration from
Route::post('async/employers/loadregister', ['as'=>'LoadEmployersRegister', 'uses'=>'Client\RegisterController@loadEmployerRegisterForm']);
//AJAX do Employer registration
Route::post('async/employers/doregister', ['as'=>'DoEmployersRegister', 'uses'=>'Client\RegisterController@doEmployerRegister']);
//AJAX get company data
Route::post('async/get/countrydata', ['as'=>'GetEmployersCountryData', 'uses'=>'Client\RegisterController@loadCountryData']);


/*======================================================================================*/



/***************************************************************************************
*
* User Routes
*/

//GET View home page
Route::get('/', ['as'=>'Home', 'uses'=>'Client\HomeController@showHome']);

//AJAX load Search in Homepage Banner
Route::post('async/loadsearch', ['as'=>'LoadHomeSearch', 'uses'=>'Client\HomeController@loadHomeSearch']);

//GET View static pages
Route::get('show/{name}', ['as'=>'ShowStaticPage', 'uses'=>'Client\HomeController@showStaticPage']);

//GET View T&C's page
Route::get('termsandconditions', ['as'=>'ShowTermsAndConditions', 'uses'=>'Client\HomeController@showTermsAndConditions']);

//GET|POST View search jobs page - @param String country_slug,  @param String state_slug
Route::any('search/jobs/{country?}/{state?}', ['as'=>'SearchJobs', 'uses'=>'Client\JobController@showSearchJobs']);

//AJAX load data for populating filters
Route::post('search/jobs/load/async/data', ['as'=>'LoadSearchJobsFilterData', 'uses'=>'Client\JobController@loadFilterData']);

//GET|POST Job Listing based on search parameters OR/AND filters OR/AND sorting order
Route::any('search/results', ['as'=>'SearchForJobs', 'uses'=>'Client\JobController@searchJobs']);

//GET|POST View search job details - @param ID job
Route::get('job/details/{id}', ['as'=>'JobDetails', 'uses'=>'Client\JobController@showJobDetails']);



//GET|POST View search job details - @param ID job
Route::post('contact-us/form', ['as'=>'ContactUsForm', 'uses'=>'Client\ContactController@doContact']);

// ACCESS LEVEL : User
Route::group(['middleware' => 'auth.user'], function () {

    //GET View profile page
    Route::get('profile', ['as'=>'Profile', 'uses'=>'Client\ProfileController@showProfile']);

    //AJAX Load resume editor
    Route::post(
        'profile/async/loadresumeeditor',
        ['as'=>'LoadResumeEditor', 'uses'=>'Client\ProfileController@loadResumeEditor']
    );
    //POST Save profile data
    Route::post('profile/saveprofile', ['as'=>'SaveProfile', 'uses'=>'Client\ProfileController@saveProfile']);

    //POST Save Resume(document)
    Route::post('profile/uploadresume', ['as'=>'UploadResume', 'uses'=>'Client\ProfileController@uploadResume']);
    //GET Delete Resume(document) - @param int resume_id
    Route::get('profile/deleteresume/{id?}', ['as'=>'DeleteResume', 'uses'=>'Client\ProfileController@deleteResume']);

    //AJAX Load Profile Summary
    Route::post(
        'profile/async/loadprofilesummary',
        ['as'=>'LoadProfileSummary', 'uses'=>'Client\ProfileController@loadProfileSummary']
    );

    //AJAX Load Employment Details
    Route::post(
        'profile/async/loademploymentdetails',
        ['as'=>'LoadEmploymentDetails', 'uses'=>'Client\ProfileController@loadEmploymentDetails']
    );
    //POST Add New EXperience data
    Route::post('profile/addexperience', ['as'=>'AddExperience', 'uses'=>'Client\ProfileController@addExperience']);
    //GET Delete Experience data - @param int experience_id
    Route::get(
        'profile/deleteexperience/{id?}',
        ['as'=>'DeleteExperience', 'uses'=>'Client\ProfileController@deleteExperience']
    );

    //AJAX Load education details
    Route::post(
        'profile/async/loadeducationdetails',
        ['as'=>'LoadEducationDetails', 'uses'=>'Client\ProfileController@loadEducationDetails']
    );
    
    //POST Save Education Details
    Route::post(
        'profile/saveeducation',
        ['as'=>'SaveEducationDetails', 'uses'=>'Client\ProfileController@saveEducationDetails']
    );

    //AJAX Load change password form
    Route::post(
        'profile/async/loadchangepassword',
        ['as'=>'LoadChangePassword', 'uses'=>'Client\ProfileController@loadChangePassword']
    );
    
    //POST Save new password
    Route::post(
        'profile/savechangepassword',
        ['as'=>'SaveChangePassword', 'uses'=>'Client\ProfileController@saveChangePassword']
    );
});
Route::group(['middleware' => 'auth.employer'], function () {
    //GET Show employer create job form
    Route::get(
        'employers/create/job',
        ['as'=>'ShowEmployersCreateJob', 'uses'=>'Client\JobController@showEmployersCreateJob']
    );
    //POST Create new job
    Route::post(
        'employers/create/job',
        ['as'=>'EmployersCreateJob', 'uses'=>'Client\JobController@doEmployersCreateJob']
    );
    //AJAX load Employers post a job
    Route::post('async/employers/loadpostajob/{id?}/{type?}', ['as'=>'LoadEmployersPostAJob', 'uses'=>'Client\JobController@loadEmployerPostAJob']);
    //AJAX load Employers post a job
    Route::post('employers/show/async/loadpostajob/{id?}/{type?}', ['as'=>'LoadEmployersPostAJob', 'uses'=>'Client\JobController@loadEmployerPostAJob']);
    //AJAX do Employers post a job
    Route::post('employers/dopostajob/{id?}', ['as'=>'DoEmployersPostAJob', 'uses'=>'Client\JobController@doEmployersPostAJob']);
    //GET Employers delete a job
    Route::get('employers/delete/jobposting/{id}', ['as'=>'DeleteEmployerJobPosting', 'uses'=>'Client\JobController@deleteEmployerJobPosting']);
    //AJAX Load data like state list and visa types available depended on country_id - @param int country_id
    Route::post(
        'jobposting/add/async/loadcountryrelateddata/{id?}',
        ['as'=>'LoadCountryRelatedData', 'uses'=>'Client\JobController@loadCountryRelatedData']
    );
    //AJAX Load data like state list and visa types available depended on country_id - @param int country_id
    Route::post(
        'employers/show/async/loadcountryrelateddata/{id?}/{job?}',
        ['as'=>'LoadCountryRelatedData', 'uses'=>'Client\JobController@loadCountryRelatedData']
    );
    //GET Show employer profile
    Route::get('employers/show/profile', ['as' => 'EmployerProfile', 'uses' => 'Client\EmployerController@showProfile']);
    //AJAX Load employer profile form
    Route::post('employers/show/async/load/profile', ['as' => 'LoadEmployerProfile', 'uses' => 'Client\EmployerController@loadProfileForm']);
    //POST Save employer profile
    Route::post('employers/save/profile', ['as' => 'SaveEmployerProfile', 'uses' => 'Client\ProfileController@saveEmployerProfile']);
    Route::post('employers/save/photo', ['as' => 'SaveEmployerPhoto', 'uses' => 'Client\ProfileController@saveEmployerPhoto']);
    //AJAX load data for populating filters
    Route::post('employers/resume/search/resumes/load/async/data', ['as'=>'LoadSearchResumesFilterData', 'uses'=>'Client\ResumeController@loadSearchFilterData']);
    //POST|GET CV search page
    Route::any('employers/resume/search', ['as' => 'ResumeSearch', 'uses' => 'Client\ResumeController@searchResumes']);
    //GET User CV Details
    Route::any('employers/resume/search/{id}', ['as' => 'ShowResumeDetails', 'uses' => 'Client\ResumeController@showResumeDetails']);
    //GET Employer job posting
    Route::any('employers/show/jobposting', ['as' => 'ShowEmployerJobPosting', 'uses' => 'Client\EmployerController@showJobPosting']);

    //GET Application
    Route::get('user/register/application/{id}/{url}', ['as' => 'RegisterJobApplication', 'uses' => 'Client\JobController@registerJobApplication']);

    //GET Applicants
    Route::get('employer/view/applicants', ['as' => 'EmployerViewAllApplicants', 'uses' => 'Client\EmployerController@viewJobApplicants']);
    //GET Posted Jobs
    Route::get('employer/view/posted/jobs', ['as' => 'EmployerViewAllPostedJobs', 'uses' => 'Client\EmployerController@viewPostedJobs']);
});

Route::group(['middleware' => 'guest.employer'], function () {
    //GET View Employers home page
    Route::get('/employers', ['as' => 'Employers', 'uses' => 'Client\EmployerController@showEmployers']);

    //AJAX load Employers banner
    Route::post('async/employers/loadbanner', ['as' => 'LoadEmployersBanner', 'uses' => 'Client\EmployerController@loadEmployersBanner']);
});

/*=======================================================================================*/


/***************************************************************************************
*
* Admin Routes
*/

// ACCESS LEVEL : Admin, SU, Moderator
Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin'], function () {

    //GET set user as admin
    Route::get('set/user/{role}/{id}', function ($role, $id) {
        $user = \App\User::find($id);
        $role = \App\Role::where('name', $role)->first();

        $user->roles()->attach($role->id);
    });

    //GET View admin dashboard
    Route::get('/', ['as'=>'Dashboard', 'uses'=>'Admin\AdminController@showHome']);

    //GET View users
    Route::get('users', ['as'=>'Users', 'uses'=>'Admin\AdminUserController@showUsers']);

    //GET Change user role
    Route::get('user/role/{type}/{id}', ['as'=>'SetUserRole', 'uses'=>'Admin\AdminUserController@setRole']);

    //GET View job listings
    Route::any('jobposting', ['as'=>'JobPosting', 'uses'=>'Admin\AdminJobController@showJobPosting']);
    
    //GET Add new job posting - **WARNING:NOT BEING USED**
    Route::get('jobposting/add', ['as'=>'AddJobPosting', 'uses'=>'Admin\AdminJobController@addJobPosting']);
    
    //GET Bulk Action:Activate - @param String listofids
    Route::get(
        'jobposting/async/bulk/activate/{list}',
        ['as'=>'BulkJobActivate', 'uses'=>'Admin\AdminJobController@bulkJobActivate']
    );
    //GET Bulk Action:Deactivate - @param String listofids
    Route::get(
        'jobposting/async/bulk/deactivate/{list}',
        ['as'=>'BulkJobDeactivate', 'uses'=>'Admin\AdminJobController@bulkJobDeactivate']
    );
    //GET Bulk Action:Send to review - @param String listofids
    Route::get(
        'jobposting/async/bulk/review/{list}',
        ['as'=>'BulkJobReview', 'uses'=>'Admin\AdminJobController@bulkJobReview']
    );
    //GET Bulk Action:Delete - @param String listofids
    Route::get(
        'jobposting/async/bulk/delete/{list}',
        ['as'=>'BulkJobDelete', 'uses'=>'Admin\AdminJobController@bulkJobDelete']
    );

    //AJAX View job details - @param int job_id
    Route::post('jobposting/async/view/{id?}', ['as'=>'ViewJobPosting', 'uses'=>'Admin\AdminJobController@viewJobPosting']);
    //AJAX Load edit job details form - @param int job_id
    Route::post('jobposting/async/edit/{id?}', ['as'=>'EditJobPosting', 'uses'=>'Admin\AdminJobController@editJobPosting']);
    //AJAX Load add job details form
    Route::post(
        'jobposting/add/async/loadform',
        ['as'=>'LoadJobPostingForm', 'uses'=>'Admin\AdminJobController@loadJobPostingForm']
    );
    //AJAX Validate job title is unique - @param var title
    Route::post(
        'jobposting/add/async/checktitle/{value?}',
        ['as'=>'CheckTitle', 'uses'=>'Admin\AdminJobController@checkTitle']
    );
    //AJAX Load data like state list and visa types available depended on country_id - @param int country_id
    Route::post(
        'jobposting/add/async/loadcountryrelateddata/{id?}/{job?}',
        ['as'=>'LoadCountryRelatedData', 'uses'=>'Admin\AdminJobController@loadCountryRelatedData']
    );
    //AJAX Load state list - @param int country_id
    Route::post(
        'register/async/loadstatelist/{id?}',
        ['as'=>'AdminLoadStateList', 'uses'=>'Client\RegisterController@loadStateList']
    );

    //POST Preview Job Details
    Route::get('jobposting/preview', ['as'=>'PreviewPosting', 'uses'=>'Admin\AdminJobController@previewJobPosting']);
    //POST Save Job Details
    Route::post('jobposting/save/{id?}', ['as'=>'SaveJobPosting', 'uses'=>'Admin\AdminJobController@saveJobPosting']);
    //GET Update job status in a cyclic order (active[1]->deactive[0]->review[2]->active[1]) - @param int job_id
    Route::get(
        'jobposting/update/status/{id?}',
        ['as'=>'UpdateJobStatus', 'uses'=>'Admin\AdminJobController@updateJobStatus']
    );
    //GET Delete job - @param int job_id;
    Route::get('jobposting/delete/{id?}', ['as'=>'DeleteJobPosting', 'uses'=>'Admin\AdminJobController@deleteJobPosting']);


    //GET View visa listings
    Route::get('visa', ['as'=>'Visa', 'uses'=>'Admin\AdminVisaController@showVisa']);

    //GET Delete visa - @param int visa_id;
    Route::get('visa/delete/{id?}', ['as'=>'DeleteVisa', 'uses'=>'Admin\AdminVisaController@deleteVisa']);

    //GET Bulk Action:Delete - @param String listofids
    Route::get('visa/async/bulk/delete/{list}', ['as'=>'BulkVisaDelete', 'uses'=>'Admin\AdminVisaController@bulkVisaDelete']);

    //GET View banner listings
    Route::get('banners', ['as'=>'Banners', 'uses'=>'Admin\AdminBannersController@showBanners']);

    //POST Save banner
    Route::post('banners/save', ['as'=>'SaveBanner', 'uses'=>'Admin\AdminBannersController@saveBanner']);

    //GET Activate banner listings
    Route::get('banners/activate/{id}', ['as'=>'ActivateBanner', 'uses'=>'Admin\AdminBannersController@activateBanner']);

    //GET Deactivate banner listings
    Route::get(
        'banners/deactivate/{id}',
        ['as'=>'DeactivateBanner', 'uses'=>'Admin\AdminBannersController@deactivateBanner']
    );

    //GET Delete banner listings
    Route::get('banners/delete/{id}', ['as'=>'DeleteBanner', 'uses'=>'Admin\AdminBannersController@deleteBanner']);


    //GET View testimonials listings
    Route::get('testimonials', ['as'=>'Testimonials', 'uses'=>'Admin\AdminTestimonialsController@showTestimonials']);

    //POST Save testimonials
    Route::post('testimonials/save', ['as'=>'SaveTestimonial', 'uses'=>'Admin\AdminTestimonialsController@saveTestimonial']);

    //GET Activate testimonials listings
    Route::get('testimonials/activate/{id}', ['as'=>'ActivateTestimonial', 'uses'=>'Admin\AdminTestimonialsController@activateTestimonial']);

    //GET Deactivate testimonials listings
    Route::get(
        'testimonials/deactivate/{id}',
        ['as'=>'DeactivateTestimonial', 'uses'=>'Admin\AdminTestimonialsController@deactivateTestimonial']
    );

    //GET Delete testimonials listings
    Route::get('testimonials/delete/{id}', ['as'=>'DeleteTestimonial', 'uses'=>'Admin\AdminTestimonialsController@deleteTestimonial']);



    //GET View static page listings
    Route::get('static/pages', ['as'=>'StaticPages', 'uses'=>'Admin\AdminStaticPagesController@showStaticPages']);

    //AJAX View static page details
    Route::post(
        'static/pages/async/view/{id?}',
        ['as'=>'ViewStaticPage', 'uses'=>'Admin\AdminStaticPagesController@viewStaticPage']
    );

    //GET New static page form
    Route::get(
        'static/pages/new',
        ['as'=>'NewStaticPage', 'uses'=>'Admin\AdminStaticPagesController@newStaticPage']
    );

    //GET Edit static page form
    Route::get(
        'static/pages/edit/{id}',
        ['as'=>'EditStaticPage', 'uses'=>'Admin\AdminStaticPagesController@editStaticPage']
    );

    //POST Save static page
    Route::post(
        'static/pages/save/{id?}',
        ['as'=>'SaveStaticPage', 'uses'=>'Admin\AdminStaticPagesController@saveStaticPage']
    );

    //GET Update static page status
    Route::get(
        'static/pages/update/{id}',
        ['as'=>'UpdateStaticPageStatus', 'uses'=>'Admin\AdminStaticPagesController@updateStaticPage']
    );


    //GET Delete static page
    Route::get(
        'static/pages/delete/{id}',
        ['as'=>'DeleteStaticPage', 'uses'=>'Admin\AdminStaticPagesController@deleteStaticPage']
    );

    //GET Bulk activate static page
    Route::get(
        'static/pages/async/bulk/activate/{list}',
        ['as'=>'BulkActivateStaticPage', 'uses'=>'Admin\AdminStaticPagesController@bulkPageActivate']
    );

    //GET Bulk deactivate static page
    Route::get(
        'static/pages/async/bulk/deactivate/{list}',
        ['as'=>'BulkDeactivateStaticPage', 'uses'=>'Admin\AdminStaticPagesController@bulkPageDeactivate']
    );

    //GET Bulk delete static page
    Route::get(
        'static/pages/async/bulk/delete/{list}',
        ['as'=>'BulkDeleteStaticPage', 'uses'=>'Admin\AdminStaticPagesController@bulkPageDelete']
    );
});

/*=======================================================================================*/
