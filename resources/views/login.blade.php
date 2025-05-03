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
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <center><h1>LOGIN</h1></center>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary  mt-3">Login</button>
        </form>
    </div>
</section>
@endsection
@section('script')
@endsection