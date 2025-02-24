@extends('layouts.auth-master')

@section('title')
    Login | T-center
@endsection

@section('content')
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="index.html" class="text-nowrap logo-img text-center d-block mb-5 w-100">
                                <img src="{{ URL::asset('dist/images/t.center-logo.png') }}" width="180" alt="" />
                            </a>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required autofocus autocomplete="username" />
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required
                                        autocomplete="current-password" />
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input primary" type="checkbox" name="remember"
                                            id="remember_me" checked />
                                        <label class="form-check-label text-dark" for="remember_me">
                                            Remeber this Device
                                        </label>
                                    </div>
                                    {{-- <a class="text-primary fw-medium" href="authentication-forgot-password.html">Forgot
                                        Password ?</a> --}}
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Login</button>
                                {{-- <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-medium">New to Modernize?</p>
                                    <a class="text-primary fw-medium ms-2" href="authentication-register.html">Create an
                                        account</a>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if (count($errors) > 0)

            Swal.fire({
                icon: 'error',
                html: '<p>@if (is_object($errors)) @foreach ($errors->all() as $error) {{ $error }}<br/> @endforeach @endif</p>',
            })
        @endif
    </script>
@endsection
