    <?php

    use App\Http\Controllers\CRUDController;
    use App\Http\Controllers\UserController;
    use Illuminate\Support\Facades\Route;

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
    });

    Route::get('/register-menu', [UserController::class, 'registerShow'])->name('register-menu');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/login-menu', [UserController::class, 'loginShow'])->name('login-menu');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    # how to add middleware to routes that i just made?
    Route::group(['middleware' => 'CheckedUser'], function () {
        Route::get('edit-siswa/{id}', [CRUDController::class, 'edit'])->name('edit-siswa');
        Route::put('update-siswa/{id}', [CRUDController::class, 'update'])->name('update-siswa');
        Route::get('delete-siswa/{id}', [CRUDController::class, 'destroy'])->name('delete-siswa');
        Route::get('/main', [CRUDController::class, 'index'])->name('main');
        Route::get('/create', [CRUDController::class, 'create'])->name('create');
        Route::post('/store', [CRUDController::class, 'store'])->name('store');
        Route::post('users/view-pdf', [CRUDController::class, 'viewPDF'])->name('view-pdf');
        Route::post('/download-pdf', [CRUDController::class, 'downloadPDF'])->name('download-pdf');
    });

    # did i do the middleware correctly?

