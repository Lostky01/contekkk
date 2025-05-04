@extends('layout.style')
@section('style')
    
@endsection
@section('content')
<section class="p-5">
    <div class="container p-5" style="background-color: white !important">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <center><h1>REGISTER</h1></center>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Register</button>
            <a href="{{ route('login-menu') }}" class="btn btn-secondary  mx-auto mt-3">Login</a>
        </form>
    </div>
</section>
@endsection
@section('script')
@endsection