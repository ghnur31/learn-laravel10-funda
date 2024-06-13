<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PdfController;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductImageController;


Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/allproducts', function(){return ProductImage::all();});
Route::get('/products/create', [ProductController::class, 'create'] );
Route::post('/products/create', [ProductController::class, 'store'] );
Route::delete('/products/{id}/delete', [ProductController::class, 'destroy'] );

Route::get('products/{productId}/upload', [ProductImageController::class, 'index']);
Route::post('products/{productId}/upload', [ProductImageController::class, 'store']);
Route::get('product-image/{productImageId}/delete', [ProductImageController::class, 'destroy']);

Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery/upload', [GalleryController::class, 'create']);
Route::post('/gallery/upload', [GalleryController::class, 'store']);
Route::delete('/gallery/{id}/delete', [GalleryController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/create', [CategoryController::class, 'create']);
Route::post('/categories/create', [CategoryController::class, 'store']);
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);
Route::put('/categories/{id}/edit', [CategoryController::class, 'update']);
Route::delete('/categories/{id}/delete', [CategoryController::class, 'destroy']);

Route::get('/generate-pdf', [PdfController::class, 'generatePdf']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
