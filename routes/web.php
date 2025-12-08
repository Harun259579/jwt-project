<?php
namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PasswordResetController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\Admin\HeroController;
use App\Http\Controllers\Web\Admin\VisionController;
use App\Http\Controllers\Web\Admin\MissionController;
use App\Http\Controllers\Web\Admin\FeatureController;
use App\Http\Controllers\Web\Admin\CommunityController;




//login Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'webLogin'])->name('login.submit');

//Forget Password
Route::get('password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/email', [PasswordResetController::class, 'sendOtp'])->name('password.email');
Route::post('password/verify-otp', [PasswordResetController::class, 'verifyOtp'])->name('password.verify-otp');
Route::post('password/update', [PasswordResetController::class, 'updatePassword'])->name('password.update');

// All logged-in users
Route::middleware(['auth'])->group(function () {

  
    // ADMIN ONLY: Dashboard + User Management
    Route::middleware(['role:admin'])->group(function () {

        // Admin Dashboard
        Route::get('/layouts/admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        // User CRUD (Admin Only)
        Route::resource('users', UserController::class);

       //Contacts 
       Route::get('admin/contacts', [ContactController::class, 'index'])
       ->name('admin.contacts');

      Route::get('admin/contact/reply/{id}', [ContactController::class, 'reply'])
      ->name('contact.reply');
      Route::post('admin/contact/reply/send', [ContactController::class, 'sendReply'])
    ->name('contact.reply.send');



      Route::get('admin/contact/delete/{id}', [ContactController::class, 'delete'])
       ->name('contact.delete');


    // Hero Section 
    Route::get('hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('hero/create', [HeroController::class, 'create'])->name('hero.create');
    Route::post('hero', [HeroController::class, 'store'])->name('hero.store');
    Route::get('hero/{id}/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('hero/{id}', [HeroController::class, 'update'])->name('hero.update');

    // Vision Section
    Route::get('vision', [VisionController::class, 'index'])->name('vission.index');
    Route::get('vision/create', [VisionController::class, 'create'])->name('vision.create'); 
    Route::post('vision', [VisionController::class, 'store'])->name('vision.store');
    Route::get('vision/{id}/edit', [VisionController::class, 'edit'])->name('vision.edit');
    Route::put('vision/{id}', [VisionController::class, 'update'])->name('vision.update');


    // Vision Section
    Route::get('mission', [MissionController::class, 'index'])->name('mission.index');
    Route::get('mission/create', [MissionController::class, 'create'])->name('mision.create'); 
    Route::post('mission', [MissionController::class, 'store'])->name('mision.store'); 
    Route::get('mission/{id}/edit', [MissionController::class, 'edit'])->name('mision.edit');
    Route::put('mission/{id}', [MissionController::class, 'update'])->name('mision.update');

    // Features
    Route::get('features', [FeatureController::class, 'index'])->name('features.index');
    Route::get('features/create', [FeatureController::class, 'create'])->name('features.create');
    Route::post('features', [FeatureController::class, 'store'])->name('features.store');
    Route::get('features/{id}/edit', [FeatureController::class, 'edit'])->name('features.edit');
    Route::put('features/{id}', [FeatureController::class, 'update'])->name('features.update');
    Route::delete('features/{id}', [FeatureController::class, 'destroy'])->name('features.destroy');

    // Community Section
    Route::get('/subscriptions', [CommunityController::class, 'index'])->name('subscriptions.index');
    
    Route::delete('/subscriptions/{id}', [CommunityController::class, 'destroy'])->name('subscriptions.delete');



    });

 
    // BLOG MODULE: Admin + Coach
  Route::middleware(['role:admin|coach|runner'])->group(function () {

// Route::middleware(['role_or_permission:admin|coach|runner'])->group(function () {


    // --- View/List Blog (Admin, Coach, Runner) ---
    Route::get('blog', [BlogController::class, 'index'])
        ->name('blog.index')
        ->middleware('permission:blog.view'); 
   

    // --- Create Blog (Admin, Coach, Runner) ---
    Route::get('blog/create', [BlogController::class, 'create'])
        ->name('blog.create')
        ->middleware('permission:blog.create');

    Route::post('blog/store', [BlogController::class, 'store'])
        ->name('blog.store')
        ->middleware('permission:blog.create');

    // --- Edit Blog (Admin, Coach, Runner) ---
    Route::get('blog/edit/{id}', [BlogController::class, 'edit'])
        ->name('blog.edit')
        ->middleware('permission:blog.edit');

    Route::put('blog/update/{id}', [BlogController::class, 'update'])
        ->name('blog.update')
        ->middleware('permission:blog.edit');

    // --- Delete Blog (Admin) ---
    
    Route::get('blog/delete/{id}', [BlogController::class, 'delete'])
        ->name('blog.delete')
        ->middleware('permission:blog.delete');
      
});


  

    Route::get('/logout', [AuthController::class, 'webLogout'])
        ->name('logout');
});




Route::get('/no-access', function() {
    return "You are not authorized!";
});
