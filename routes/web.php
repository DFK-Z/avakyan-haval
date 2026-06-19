<?php

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StockController;
use App\Models\BlogPost;
use App\Models\CarModel;
use App\Models\Service;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

Route::get('/', fn () => view('home'))->name('home');
Route::get('/catalog', fn () => view('catalog'))->name('catalog');
Route::get('/cars/{car:slug}', [CarController::class, 'show'])->name('cars.show');

Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
Route::get('/offers', [OfferController::class, 'index'])->name('offers.index');
Route::get('/dealers', [DealerController::class, 'index'])->name('dealers.index');

Route::get('/credit', [PageController::class, 'credit'])->name('credit');
Route::get('/insurance', [PageController::class, 'insurance'])->name('insurance');
Route::get('/leasing', [PageController::class, 'leasing'])->name('leasing');
Route::get('/corporate', [PageController::class, 'corporate'])->name('corporate');
Route::get('/trade-in', [PageController::class, 'tradeIn'])->name('trade-in');
Route::get('/owners', [PageController::class, 'owners'])->name('owners');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');

Route::get('/service', fn () => view('service.index'))->name('service.index');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/parts', fn () => view('parts.index'))->name('parts.index');
Route::get('/accessories', [AccessoryController::class, 'index'])->name('accessories.index');

Route::middleware('auth')->group(function (): void {
    Route::get('/account', fn () => view('account'))->name('account');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create()
        ->add(Url::create(route('home')))
        ->add(Url::create(route('catalog')))
        ->add(Url::create(route('stock.index')))
        ->add(Url::create(route('offers.index')))
        ->add(Url::create(route('dealers.index')))
        ->add(Url::create(route('credit')))
        ->add(Url::create(route('owners')))
        ->add(Url::create(route('services.index')))
        ->add(Url::create(route('blog.index')));

    CarModel::query()->where('is_active', true)->each(fn (CarModel $car) => $sitemap->add(Url::create(route('cars.show', $car))));
    Service::query()->where('is_active', true)->each(fn (Service $s) => $sitemap->add(Url::create(route('services.show', $s))));
    BlogPost::query()->where('is_published', true)->each(fn (BlogPost $p) => $sitemap->add(Url::create(route('blog.show', $p))));

    return response($sitemap->render(), 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');
