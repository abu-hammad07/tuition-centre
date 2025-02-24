@extends('layouts.master')

@section('title')
    {{ isset($singleUser->id) ? 'User Update' : 'User Add' }} | T-Center
@endsection

@section('content')
    <!-- --------------------------------------------------- -->
    <!-- Main Start -->
    <!-- --------------------------------------------------- -->
    <div class="container-fluid">
        <!-- --------------------------------------------------- -->
        <!--  User added Start -->
        <!-- --------------------------------------------------- -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">
                            {{ isset($singleUser->id) ? 'User Update' : 'User Add' }}
                        </h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    {{ isset($singleUser->id) ? 'User Update' : 'User Add' }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ URL::asset('dist/images/breadcrumb/ChatBc.png') }}" alt=""
                                class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Income Form (Start) -->
        <div class="card">
            <div class="row border-bottom ">
                <div class="col-md-6 col-6">
                    <div class="title-part-padding mt-2">
                        <h4 class="card-title mb-0 fs-7 text-primary">
                            {{ isset($singleUser->id) ? 'User Update' : 'User Add' }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="title-part-padding text-end">
                        <a href="{{ route('userList') }}" class="btn btn-outline-primary  fw-semibold fs-4">
                            <i class="ti ti-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('userPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ isset($singleUser->id) ? $singleUser->id : null }}">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required
                                value="{{ old('name', $singleUser->name ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required
                                value="{{ old('username', $singleUser->username ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required
                                value="{{ old('email', $singleUser->email ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password"
                                value="{{ old('password') }}" @if (!request()->is('*/edit/*')) required @endif />
                            @if (request()->is('*/edit/*'))
                                <span class="text-danger">If you want to change password then leave this field blank</span>
                            @endif
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-control form-select" required>
                                <option value="">--- Select Role ---</option>
                                <option value="User"
                                    {{ old('role', $singleUser->role ?? '') == 'User' ? 'selected' : '' }}>User</option>
                                <option value="Admin"
                                    {{ old('role', $singleUser->role ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control form-select" required>
                                <option value="">--- Select Status ---</option>
                                <option value="1"
                                    {{ old('status', $singleUser->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0"
                                    {{ old('status', $singleUser->status ?? '') == '0' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control form-select" required>
                                <option value="">--- Select Gender ---</option>
                                <option value="Male"
                                    {{ old('gender', $singleUser->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('gender', $singleUser->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Phone No</label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter Phone No"
                                value="{{ old('phone', $singleUser->phone ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Image</label>
                            <input type="file" name="image" class="form-control"
                                value="{{ old('image', $singleUser->image ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        </div>

                    </div>
                    <!-- Submit Button -->
                    <div class="col-md-12 mt-4 text-end">
                        <button type="submit" class="btn btn-primary fs-4">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Income Form (End) -->



        <!-- --------------------------------------------------- -->
        <!--  User added End -->
        <!-- --------------------------------------------------- -->
    </div>
@endsection

@section('scripts')
    @include('__messages')
@endsection
