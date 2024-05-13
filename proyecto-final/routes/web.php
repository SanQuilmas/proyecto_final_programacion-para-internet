<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\ISBNController;
use App\Mail\CatalogoEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard')->with(['libros' => \App\Models\Libro::all()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::resource('libros', LibroController::class);
Route::resource('autors', AutorController::class);
Route::resource('isbn', ISBNController::class);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/index', [ProfileController::class, 'index'])
        ->name('profile.index');
    Route::get('/admin/index/restore/{op}/{id}', [ProfileController::class, 'restore'])
        ->name('profile.restore');
    Route::get('/admin/index/delete/{op}/{id}', [ProfileController::class, 'forceDelete'])
        ->name('profile.forceDelete');
    Route::get('/admin/index/changeStatus/{id}', [ProfileController::class, 'cambiarStatusAdmin'])
        ->name('profile.cambiarStatusAdmin');
});

Route::get('/descargar/{archivo}', [LibroController::class, 'descargarArchivo'])
    ->name('descargar');

#Route::get('/bugreport', function() {
#    $name = "Funny Coder";
#    Mail::to('leonelgonzalezvalencia12@gmail.com')->send(new CatalogoEmail($name));
#})->name('bugreport');

Route::get('/bugreport', [ProfileController::class, 'bugreport'])
    ->name('bugreport');
    
Route::post('/sendBugreport', [ProfileController::class, 'sendBugreport'])
    ->name('profile.sendBugreport');

require __DIR__.'/auth.php';
