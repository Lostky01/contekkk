# dwadwafaww

## Deskripsi
blalblaba

## Langkah-langkah Instalasi

### 1. Instal Laravel 10

Jalankan perintah berikut untuk menginstall Laravel 10:

```bash
composer create-project "laravel/laravel:^10.0" project-ujikom
```

### 2. Konfigurasi Database

Setelah berhasil menginstal, buka file `.env` dan sesuaikan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_ujikom
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Buat Migration

Jalankan perintah berikut untuk membuat migration untuk `user` dan `pengguna`:

```bash
php artisan make:migration user
php artisan make:migration pengguna
```

### 4. Edit Migration File

Pada file migration untuk `user`, isikan kode berikut:

```php
public function up(): void
{
    Schema::create('siswa', function (Blueprint $table) {
        $table->id();
        $table->string('nisn',10)->unique();
        $table->string('nama',50);
        $table->string('tempat_lahir',30);
        $table->date('tanggal_lahir');
        $table->string('alamat',225);
        $table->string('telepon',15);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('siswa');
}
```

Dan pada file migration untuk `pengguna`, isikan kode berikut:

```php
public function up(): void
{
    Schema::create('pengguna', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('username');
        $table->string('password');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('pengguna');
}
```

### 5. Buat Controller

Jalankan perintah untuk membuat controller `UserController` dan `CRUDController`:

```bash
php artisan make:controller UserController
php artisan make:controller CRUDController
```

### 6. Isi Fungsi di UserController

Pada file `UserController.php`, isi dengan fungsi `registerShow`, `register`, `loginShow`, `login`, dan `logout` seperti berikut:

```php
public function registerShow() {
    return view('register');
}

public function register(Request $request) {
    $request->validate([
        'username' => 'required',
        'nama' => 'required',
        'password' => 'required'
    ]);

    $user = new Pengguna();
    $user->nama = $request->nama;
    $user->username = $request->username;
    $user->password = $request->password;
    $user->save();

    return back()->with('success', 'Registrasi berhasil!');
}

public function loginShow() {
    return view('login');
}

public function login(Request $request) {
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $user = Pengguna::where('username', $request->username)->first();
    if($user->password == $request->password) {
        session(['user' => $user]);
        return redirect()->route('main')->with('success', 'Login berhasil!, selamat datang user ' . $user->nama);
    } else {
        return redirect()->back()->with('error', 'Username atau password salah!');
    }
}

public function logout() {
    session()->flush();
    return redirect()->route('login');
}
```

### 7. Isi Fungsi di CRUDController

Pada file `CRUDController.php`, buat beberapa fungsi untuk menangani CRUD data siswa:

```php
public function index() {
    $data = Siswa::all();
    return view('main', compact('data'));
}

public function create() {
    return view('add-siswa');
}

public function store(Request $request) {
    $request->validate([
        'nama' =>'required',
        'nisn' =>'required',
        'tempat_lahir' =>'required',
        'tanggal_lahir' =>'required',
        'alamat' =>'required',
        'telepon' =>'required'
    ]);

    $siswa = new Siswa();
    $siswa->nama = $request->nama;
    $siswa->nisn = $request->nisn;
    $siswa->tempat_lahir = $request->tempat_lahir;
    $siswa->tanggal_lahir = $request->tanggal_lahir;
    $siswa->alamat = $request->alamat;
    $siswa->telepon = $request->telepon;
    $siswa->save();
    return redirect()->route('main');
}

public function edit($id) {
    $siswa = Siswa::findOrFail($id);
    return view('edit-siswa', compact('siswa'));
}

public function update(Request $request, $id) {
    $request->validate([
        'nama' =>'required',
        'nisn' => 'required',
        'tempat_lahir' =>'required',
        'tanggal_lahir' =>'required',
        'alamat' =>'required',
        'telepon' =>'required'
    ]);

    $siswa = Siswa::findOrFail($id);
    $siswa->nama = $request->nama;
    $siswa->nisn = $request->nisn;
    $siswa->tempat_lahir = $request->tempat_lahir;
    $siswa->tanggal_lahir = $request->tanggal_lahir;
    $siswa->alamat = $request->alamat;
    $siswa->telepon = $request->telepon;
    $siswa->save();
    return redirect()->route('main');
}

public function destroy($id) {
    $siswa = Siswa::find($id);
    $siswa->delete();
    return redirect()->route('main');
}
```

### 8. Install DomPDF untuk export PDF

Jalankan perintah berikut untuk menginstall package `barryvdh/laravel-dompdf`:

```bash
composer require barryvdh/laravel-dompdf
```

### 9. Isi Fungsi di CRUDController

Pada file `CRUDController.php`, tambahkan fungsi `downloadPDF` untuk mengexport data siswa ke PDF:

```php
public function downloadPDF()
    {
        $data = Siswa::all();
        $pdf = PDF::loadView('pdf', array('data' =>  $data))
        ->setPaper('a4', 'portrait');
        return $pdf->download('data.pdf');

    }
```

### 10. Konfigurasi Route

Di dalam file `web.php`, tambahkan routing seperti berikut:

```php
Route::get('/register-menu', [UserController::class, 'registerShow'])->name('register-menu');
Route::post('/register', [UserController::class,'register'])->name('register');
Route::get('/login-menu', [UserController::class, 'loginShow'])->name('login-menu');
Route::post('/login', [UserController::class,'login'])->name('login');
Route::get('edit-siswa/{id}', [CRUDController::class, 'edit'])->name('edit-siswa');
Route::put('update-siswa/{id}', [CRUDController::class, 'update'])->name('update-siswa');
Route::get('delete-siswa/{id}', [CRUDController::class, 'destroy'])->name('delete-siswa');
Route::get('/main', [CRUDController::class, 'index'])->name('main');
Route::get('/create', [CRUDController::class, 'create'])->name('create');
Route::post('/store', [CRUDController::class,'store'])->name('store');
Route::post('/download-pdf', [CRUDController::class, 'downloadPDF'])->name('download-pdf');
```

### 11. Buat View PDF

Buat file `pdf.blade.php` di dalam folder `resources/views` dengan isi seperti berikut:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<body>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nisn</th>
                <th scope="col">Nama</th>
                <th scope="col">Tempat Lahir</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Alamat</th>
                <th scope="col">Telepon</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $d)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $d->nisn }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->tempat_lahir }}</td>
                    <td>{{ $d->tanggal_lahir }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td>{{ $d->telepon }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
```

### 12. Jalankan Aplikasi

Sekarang jalankan perintah berikut untuk menjalankan aplikasi:

```bash
php artisan migrate
php artisan serve
```

Akses aplikasi melalui browser dengan URL `http://127.0.0.1:8000`.

## Penutup

Dengan mengikuti tutorial ini, kamu telah berhasil membuat aplikasi CRUD sederhana menggunakan Laravel 10. Semoga tutorial ini membantu dalam ujikommu!

### <h1>UPDATE HOW TO ADD MIDDLEWARE</h1>

Jalankan perintah

```bash
php artisan make:middleware AuthCheck
```

Buka file `app/Http/Kernel.php` dan tambahkan middleware `AuthCheck` di dalam array `middlewareGroups` seperti berikut:

```php
protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\AuthCheck::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];


 protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'CheckedUser' => \App\Http\Middleware\AuthCheck::class,
    ];
```

Buka file `app/Http/Middleware/AuthCheck.php` dan tambahkan kode berikut:

```php
public function handle(Request $request, Closure $next): Response
    {
        $allowedRoutes = ['login-menu', 'login', 'register-menu', 'register'];

        if (!session()->has('user') && !in_array($request->route()->getName(), $allowedRoutes)) {
            return redirect()->route('login-menu');
        }

        return $next($request);
    }
```

### <h1>NEW FUNCTION</h1>

Generate Random String untuk password dan pembaruan method login

```php
public function generateToken($length = 64)
{
    return Str::random($length);
}

public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);


        $user = Pengguna::where('username', $request->username)->first();
        if($user && $user->password == $request->password) {
            /* dd($this->generateToken());  */
            session([
                'user' => $user,
                'token' => $this->generateToken()
            ]);
            /* dd('login succesful, your token is ' . session('token')); */
            return redirect()->route('main')->with('success', 'Login berhasil!, selamat datang ' . $user->nama);
        } else {
            return redirect()->back()->with('error', 'Username atau password salah!');
            /* dd('the password is incorrect' . $user); */
        }
    }
```

Pembaruan fungsi logout

```php
public function logout() {
    session()->flush();
    session()->forget('user');
    session()->forget('token');
    return redirect()->route('login-menu');
}
```
