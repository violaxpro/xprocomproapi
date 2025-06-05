<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('blog', [BlogController::class, 'index']);
Route::get('blog/{slug}', [BlogController::class, 'show']);

Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{slug}', [ProjectController::class, 'show']);

Route::post('contact-us', [AuthController::class, 'login']);

Route::get('home', [PageController::class, 'home']);
Route::get('sitemap', [PageController::class, 'getSitemap']);
Route::get('faq', [PageController::class, 'faq']);
Route::post('contact', [PageController::class, 'ContactRequest']);
Route::get('category-pages/{slug}', [PageController::class, 'categoryPage']);
Route::get('pages/{slug}', [PageController::class, 'page']);

Route::group(['prefix' => 'admin'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::post('upload-image', [FileController::class, 'uploadImage']);
    Route::get('settings', [SettingController::class, 'index']);

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::get('dashboard/contact', [DashboardController::class, 'contact']);
        Route::get('dashboard/visitor', [DashboardController::class, 'visitor']);
        Route::post('logout', [AuthController::class, 'logout']);

        Route::post('settings', [SettingController::class, 'store']);

        Route::apiResources([
            'brands' => BrandController::class,
            'blogs' => AdminBlogController::class,
            'blog-categories' => BlogCategoryController::class,
            'categories' => CategoryController::class,
            'category-pages' => CategoryPageController::class,
            'faqs' => FaqController::class,
            'faq-categories' => FaqCategoryController::class,
            'testimonials' => TestimonialController::class,
            'pages' => AdminPageController::class,
            'projects' => AdminProjectController::class,
            'users' => AdminUserController::class,
        ]);

        Route::get('blogs/{id}/edit', [AdminBlogController::class, 'edit']);
        Route::get('pages/{id}/edit', [AdminPageController::class, 'edit']);

        Route::get('faq-categories-select', [FaqCategoryController::class, 'select']);
        Route::get('brand-select', [BrandController::class, 'select']);
        Route::get('page-select', [AdminPageController::class, 'select']);
        Route::get('category-select', [CategoryController::class, 'select']);

    });
});
