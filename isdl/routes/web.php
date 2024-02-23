<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth;
use App\Http\Controllers\gsec;
use App\Http\Controllers\mentor;
use App\Http\Controllers\AR;
use Illuminate\Http\Request;
use App\Http\Middleware\middle;
use App\Http\Controllers\table;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->withoutMiddleware(middle::class);

Route::get('/logout', function (Request $request) {
    $request->session()->flush();
    return redirect('/');
})->withoutMiddleware(middle::class);

Route::prefix('gsec')->group(function () {
    Route::get('/', function () {
        return view('gsec');
    });

    Route::get('/view', [gsec::class, 'showList']);

    Route::post('/request', [gsec::class, 'createRequest']);

    Route::get('/logout', function (Request $request) {
        $request->session()->flush();
        return redirect('/');
    })->withoutMiddleware(middle::class);

});

Route::prefix('mentor')->group(function () {
    Route::get('/', function () {
        return view('mentor');
    });

    Route::get('/view', [mentor::class, 'showList']);

    Route::get('/requestId', [mentor::class, 'reqestId']);

    Route::post('/approve', [mentor::class, 'approve']);

    Route::get('/logout', function (Request $request) {
        $request->session()->flush();
        return redirect('/');
    })->withoutMiddleware(middle::class);

});


Route::prefix('SA')->group(function () {
    Route::get('/', function () {
        return view('mentor');
    });

    Route::get('/view', [mentor::class, 'showList']);

    Route::get('/requestId', [mentor::class, 'reqestId']);

    Route::post('/approve', [mentor::class, 'approve']);

    Route::get('/logout', function (Request $request) {
        $request->session()->flush();
        return redirect('/');
    })->withoutMiddleware(middle::class);

});

Route::prefix('guard')->group(function () {
    
    Route::get('/', function () {
        return view('table');
    });
    
    Route::get('/data', [table::class, 'LTdata']);

    Route::get('/logout', function (Request $request) {
        $request->session()->flush();
        return redirect('/');
    })->withoutMiddleware(middle::class);

});

Route::prefix('AR')->group(function () {
    Route::get('/', function () {
        return view('AR');
    });

    Route::get('/view', [AR::class, 'showList']);

    Route::get('/requestId', [mentor::class, 'reqestId']);

    Route::post('/availableLT', [AR::class, 'availableLT']);

    Route::post('/BookLT', [AR::class, 'bookLT']);

    Route::get('/logout', function (Request $request) {
        $request->session()->flush();
        return redirect('/');
    })->withoutMiddleware(middle::class);

    Route::prefix('table')->group(function () {
    
        Route::get('/', function () {
            return view('table');
        });
        
        Route::get('/data', [table::class, 'LTdata']);
    
    });

});

Route::post('/', [auth::class, 'check_login'])->withoutMiddleware(middle::class);
