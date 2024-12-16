<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LguController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BarangayOfficialController;
use App\Http\Controllers\CertificateRequestController;
use App\Http\Controllers\Certificates\ResidencyController;
use App\Http\Controllers\Certificates\UnifastController;
use App\Http\Controllers\CustomCertificateController;
use App\Http\Controllers\SuperAdminAnnouncementController;

//home routing
Route::get('/', function () {
    return view('home.index');
});

//lgu login route
Route::get('/lgu-login', function () {
    return view('login.login-form');
});

//barangay login route
Route::get('/barangay-login', function () {
    return view('login.barangay-login');
});

//tagsa ka barangay logins
Route::get('/login/{barangay_name}', [BarangayController::class, 'showLoginPage'])->name('barangay.login');


/*  Dashboard access dere, pang verification purpose.
    Gi butangan ug condition para ang iyang access
    ma sud sa dashboard sa naka assign nga role.  
                |  |  |
                V  V  V
*/
Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('superAdmin')) {
        return view('lgu.dashboard'); // LGU dashboard
    } elseif (auth()->user()->hasRole('admin')) {
        return view('barangay.dashboard'); // Barangay admin dashboard
    } elseif (auth()->user()->hasRole('user')) {
        return view('user.dashboard'); // Barangay user dashboard
    } else {
        abort(403, 'Unauthorized action.'); // No record/role login access
    }
})->middleware(['auth', 'verified'])->name('dashboard');


/*  Built in routes for login using breeze,not included in our provided acces since we 
    dont have profile access for each users.
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*  Dere na ang gi group na role para sa tagsa nilang access.
    By the way, ang iyang first na route nga ga kuha ug lgu dashboard or admin or user,
    para na sa access sa iyang Sidebar nga naa sud sa folder kada role
                |  |  |
                V  V  V
*/
Route::middleware('auth')->group(function () {

    // LGU (superAdmin) Routes
    Route::middleware(['role:superAdmin'])->group(function () {

        //routes
        Route::get('/barangays/create', [LguController::class, 'createBarangay'])->name('lgu.create-newBarangay');
        Route::post('/barangays', [LguController::class, 'storeBarangay'])->name('lgu.store-barangay');
    
        //announcements
        Route::get('/lgu-announcement', [SuperAdminAnnouncementController::class, 'index'])->name('superadmin.announcements.index');
        Route::get('/lgu-announcement/{announcement}', [SuperAdminAnnouncementController::class, 'show'])->name('superadmin.announcement.show');
        Route::get('/lgu-announcement/create', [SuperAdminAnnouncementController::class, 'create'])->name('superadmin.announcements.create');
        Route::post('/lgu-announcement/store', [SuperAdminAnnouncementController::class, 'store'])->name('superadmin.announcements.store'); 
        Route::put('/lgu-announcement/{announcement}', [SuperAdminAnnouncementController::class, 'updateAnnouncement'])->name('superadmin.announcement.update');

        //barangay list & admin
        Route::get('/lgu', [LguController::class, 'index'])->name('lgu.dashboard');
        Route::put('/barangays/{barangay}', [LguController::class, 'update'])->name('lgu.barangays-update');//route to show edit
        Route::get('/barangays', [LguController::class, 'barangaysList'])->name('lgu.barangays-list');//route to show barangays
        Route::get('/barangays/{barangay}', [LguController::class, 'show'])->name('lgu.barangays-show');//route to show baranagay info
        Route::get('/admins', [LguController::class, 'admins'])->name('lgu.admins');//route to show admins of barangay
        Route::get('/barangay-admins/{adminUser}/edit', [LguController::class, 'editAdmin'])->name('lgu.admins-crud.edit-barangay-admin');
        Route::put('/barangay-admins/{adminUser}', [LguController::class, 'updateAdmin'])->name('lgu.admins-crud.update-barangay-admin');
        Route::delete('/barangay-admins/{admin}', [LguController::class, 'destroyAdmin'])->name('lgu.admins-crud.delete-barangay-admin');
        Route::get('/lgu/create-barangay', [LguController::class, 'createBarangayForm'])->name('lgu.create-barangay');//rotue to show /lgu/store-barangay 

        //crud
        Route::get('/barangays/{barangay}/edit', [LguController::class, 'edit'])->name('lgu.barangays-edit');//edit barangay information
        Route::post('/lgu/store-barangay-admin', [LguController::class, 'storeBarangayAdmin'])->name('lgu.store-barangay-admin');//create barangay admin

        //Profile Route
        Route::get('/super-admin-profile', [ProfileController::class, 'editSuperAdmin'])->name('lgu.profile.edit');
        Route::patch('/super-admin-profile', [ProfileController::class, 'updateSuperAdmin'])->name('lgu.profile.update');
        Route::delete('/super-admin-profile', [ProfileController::class, 'destroySuperAdmin'])->name('lgu.profile.destroy');
        Route::put('/super-admin/{superadmin}', [ProfileController::class, 'updateSuperAdminImage'])->name('lgu.lgus-update');
    
    });

    // Barangay (admin) Routes
    Route::middleware(['role:admin'])->group(function () {

    //Dashboard
        Route::get('/barangay-dashboard', [BarangayController::class, 'index'])->name('barangay.dashboard');
        Route::get('/barangay', [BarangayController::class, 'index'])->name('barangay.index');
        Route::get('barangay/residents/{resident_id}/view', [BarangayController::class, 'viewResident'])->name('barangay.residents.view');
        Route::get('/barangay/create-user', [BarangayController::class, 'createUserForm'])->name('barangay.create-user');
        Route::post('/barangay/store-user', [BarangayController::class, 'storeUser'])->name('barangay.store-user');
        Route::get('barangay/residents/{resident_id}/edit', [BarangayController::class, 'editResident'])->name('barangay.residents.edit');
        Route::put('barangay/residents/{resident_id}', [BarangayController::class, 'updateResident'])->name('barangay.residents.update');
        Route::get('/resident/{id}/edit', [BarangayController::class, 'edit'])->name('resident.edit');

        Route::delete('barangay/residents/{resident_id}', [BarangayController::class, 'deleteResident'])->name('barangay.residents.delete');


    //BarangayOfficials
        Route::get('/barangay/officials/create', [BarangayOfficialController::class, 'createOfficial'])->name('barangay.officials.create');
        Route::post('/barangay/officials/store', [BarangayOfficialController::class, 'storeOfficial'])->name('barangay.officials.store');    
        Route::get('/barangay/{official}/edit', [BarangayOfficialController::class, 'editOfficial'])->name('barangay.officials.edit');
        Route::put('/barangay/{official}', [BarangayOfficialController::class, 'updateOfficial'])->name('barangay.officials.update');
        Route::delete('/barangay/officials/{official}', [BarangayOfficialController::class, 'destroyOfficial'])->name('barangay.officials.destroy');


    //Residents Account
        Route::get('/residentUser', [BarangayController::class, 'residentUser'])->name('barangay.user.index');
        Route::get('/barangay/create-User', [BarangayController::class, 'createResidentUserForm'])->name('barangay.user.createUser');
        Route::post('/barangay/storeResidentUser', [BarangayController::class, 'storeResidentUser'])->name('barangay.storeResidentUser');
        Route::get('/user/{user}/edit', [BarangayController::class, 'editUser'])->name('barangay.user.edit');
        Route::put('/user/{user}', [BarangayController::class, 'updateUser'])->name('barangay.user.update');
        Route::get('/barangay/create-purok', [PurokController::class, 'createPurok'])->name('barangay.purok.createPurok');
        Route::post('/barangay/storePurok', [PurokController::class, 'storePurok'])->name('barangay.purok.storePurok');
        Route::get('/purok/{purok}', [PurokController::class, 'viewPurok'])->name('purok.residents');
        Route::post('residents/export-excel', [ResidentController::class, 'exportExcel'])->name('residents.download-excel');
        Route::post('/user/{user}/toggle-status', [BarangayController::class, 'toggleUserStatus'])->name('barangay.user.toggleStatus');


    
    //Residents
        Route::get('/residents', [ResidentController::class, 'index'])->name('barangay.residents.index');
        Route::delete('barangay/user/{user_id}', [UserController::class, 'deleteUser'])->name('barangay.user.index.delete');


    //Budget Reports
        Route::get('/reports', [BudgetController::class, 'index'])->name('barangay.budget-report.index');
        Route::get('/barangay/create-budgetReport', [BudgetController::class, 'createBudgetReport'])->name('barangay.create-budgetReport');
        Route::post('/barangay/store-budgetReport', [BudgetController::class, 'storeBudgetReport'])->name('barangay.store-budgetReport');
        Route::get('barangay/budget-report/{budgetReport}/edit', [BudgetController::class, 'editBudgetReport'])->name('barangay.budget-report.edit');
        Route::put('barangay/budget-report/{budgetReport}', [BudgetController::class, 'updateBudgetReport'])->name('barangay.budget-report.update');
        Route::delete('/barangay/budget-report/{budgetReport}', [BudgetController::class, 'deleteBudgetReport'])->name('barangay.budget-report.delete');
        Route::post('budgets/export-excel', [BudgetController::class, 'exportExcel'])->name('budgets.download-excel');

    
    //Announcements
        Route::get('/announcement/{announcement}', [AnnouncementController::class, 'show'])->name('barangay.announcement.show');
        Route::get('/announcements/show', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::put('/announcements/{announcement}', [AnnouncementController::class, 'updateAnnouncement'])->name('barangay.announcement.update');
        Route::get('/announcements/previous', [AnnouncementController::class, 'previousView'])->name('announcements.previous');
        Route::get('/barangay/announcement/archived', [AnnouncementController::class, 'archived'])->name('barangay.announcement.archived');
        Route::post('/barangay/announcement/restore/{id}', [AnnouncementController::class, 'restore'])->name('barangay.announcement.restore');


    //Complaints
        Route::get('/complaints', [ComplaintController::class, 'barangayComplaints'])->name('barangay.complaints.index');
        Route::get('/barangay/complaints/{complaint}', [ComplaintController::class, 'viewComplaint'])->name('barangay.complaints.view');
        Route::post('/barangay/complaints/{complaint}/reply', [ComplaintController::class, 'replyComplaint'])->name('barangay.complaints.reply');
        Route::get('/barangay/complaints/{complaint}/edit-reply', [ComplaintController::class, 'editReply'])->name('barangay.complaints.edit-reply');
        Route::put('/barangay/complaints/{complaint}/update-reply', [ComplaintController::class, 'updateReply'])->name('barangay.complaints.update-reply');

    //Logs
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

    //Certificates
        Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
        Route::get('/certificate-requests/{id}/edit', [CertificateRequestController::class, 'edit'])->name('certificate_requests.edit');
        Route::put('/certificate-requests/{id}', [CertificateRequestController::class, 'update'])->name('certificate_requests.update');
        Route::get('/certificates/custom/template', [CustomCertificateController::class, 'indexCustom'])->name('certificates.indexCustom');
        Route::get('/certificate/{certificateId}/{requesterName}_{certificateType}_{date}', [CertificateController::class, 'downloadCertificatePDF'])->name('certificate.download');
        Route::get('/custom-certificate/{certificateId}/{requesterName}_{certificateType}_{date}', [CustomCertificateController::class, 'downloadCustomCertificatePDF'])->name('custom-certificate.download');

    //custom certificate
    Route::get('/custom-certificate/{id}/edit', [CustomCertificateController::class, 'edit'])->name('custom_certificate.edit');
    Route::put('/certificates/custom/{id}', [CustomCertificateController::class, 'update'])->name('custom_certificate.update');

    //Puroks
        Route::get('/puroks', [PurokController::class, 'index'])->name('puroks.index');

    //Profile Route
        Route::get('/admin-profile', [ProfileController::class, 'editAdmin'])->name('barangay.profile.edit');
        Route::patch('/admin-profile', [ProfileController::class, 'updateAdmin'])->name('barangay.profile.update');
        Route::delete('/admin-profile', [ProfileController::class, 'destroyAdmin'])->name('barangay.profile.destroy');
        Route::put('/admin/{admin}', [ProfileController::class, 'updateAdminImage'])->name('admin.admins-update');



    });

    // User Routes
    Route::middleware(['role:user'])->group(function () {

        //Dashboard
        Route::get('/user-dashboard', [UserController::class, 'index'])->name('user.dashboard');

        //Announcements
        Route::get('/announcements', [AnnouncementController::class, 'userIndex'])->name('user.announcement.index');
        Route::get('/announcementUser/{announcement}', [AnnouncementController::class, 'showUser'])->name('user.announcement.show');
        Route::get('/announcementView/previous', [AnnouncementController::class, 'userPreviousView'])->name('user.announcement.previous');

        //BudgetReports
        Route::get('/budget-reports', [BudgetController::class, 'userIndex'])->name('user.budget-report.index');
        Route::post('user-budgets/export-excel', [BudgetController::class, 'userExportExcel'])->name('user.budgets.download-excel');

        //Complaints
        Route::get('/user-complaints', [ComplaintController::class, 'userIndex'])->name('user.complaint.index');
        Route::get('/user-complaints/create', [ComplaintController::class, 'create'])->name('user.complaint.create');
        Route::post('/complaints/store', [ComplaintController::class, 'storeComplaint'])->name('user.complaint.store');

        //Certificates Route
        Route::get('/residencyCert', [CertificateController::class, 'residencyIndex'])->name('user.certificates.residency');
        Route::get('/unifastCert', [CertificateController::class, 'unifastIndex'])->name('user.certificates.unifast');
        Route::get('/unemploymentCert', [CertificateController::class, 'unemploymentIndex'])->name('user.certificates.unemployment');
        Route::get('/indigencyCert', [CertificateController::class, 'indigencyIndex'])->name('user.certificates.indigency');
        Route::get('/jobseekCert', [CertificateController::class, 'jobseekIndex'])->name('user.certificates.jobseek');

        //Certificates Add
        Route::post('/unifast/store', [UnifastController::class, 'store'])->name('unifast.store');

        Route::post('/residency/store', [ResidencyController::class, 'store'])->name('certificates.residences.store');

        Route::get('/certificates/customized', [CustomCertificateController::class, 'create'])->name('certificates.customized');
        Route::get('/certificates/create', [CustomCertificateController::class, 'createTemplate'])->name('certificates.createTemplate');
        Route::post('/certificates/customized', [CustomCertificateController::class, 'submit'])->name('certificates.customized.submit');


        //or number edit

        Route::put('/certificates/{certResidency}', [ResidencyController::class, 'updateOrNumber'])->name('certificates.update.or-number');

        Route::get('/certificates/request', [CertificateRequestController::class, 'create'])->name('certificates.request');
        Route::post('/certificates/request', [CertificateRequestController::class, 'store'])->name('certificates.store');


       //Profile
        Route::get('/user-profile', [ProfileController::class, 'editUser'])->name('user.profile.edit');
        Route::patch('/user-profile', [ProfileController::class, 'updateUser'])->name('user.profile.update');
        Route::delete('/user-profile', [ProfileController::class, 'destroyUser'])->name('user.profile.destroy');
        Route::put('/user/{user}', [ProfileController::class, 'updateUserImage'])->name('user.users-update');
        
    });
    
});

require __DIR__.'/auth.php';
