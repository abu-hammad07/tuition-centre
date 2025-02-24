@extends('layouts.master')

@section('title')
    {{ isset($singleStudent->id) ? 'Student Update' : 'Student Add' }} | T-Center
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
                            {{ isset($singleStudent->id) ? 'Student Update' : 'Student Add' }}
                        </h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    {{ isset($singleStudent->id) ? 'Student Update' : 'Student Add' }}
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
                            {{ isset($singleStudent->id) ? 'Student Update' : 'Student Add' }}
                        </h4>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                    <div class="title-part-padding text-end">
                        <a href="{{ route('studentList') }}" class="btn btn-outline-primary  fw-semibold fs-4">
                            <i class="ti ti-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('studentPost') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ isset($singleStudent->id) ? $singleStudent->id : null }}">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control" placeholder="Enter Full Name" 
                                value="{{ old('full_name', $singleStudent->full_name ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('full_name') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Father Name <span class="text-danger">*</span></label>
                            <input type="text" name="guardian_name" class="form-control" placeholder="Enter Father Name" 
                                value="{{ old('guardian_name', $singleStudent->guardian_name ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('guardian_name') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Email (optional)</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                value="{{ old('email', $singleStudent->email ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Phone No (optional)</label>
                            <input type="number" name="guardian_phone" class="form-control" placeholder="Enter Phone No"
                                value="{{ old('guardian_phone', $singleStudent->guardian_phone ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('guardian_phone') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Class Name <span class="text-danger">*</span></label>
                            <input type="text" name="class_name" class="form-control" placeholder="Enter Class Name" 
                                value="{{ old('class_name', $singleStudent->class_name ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('class_name') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="dob" class="form-control" placeholder="Enter Date of Birth" 
                                value="{{ old('dob', $singleStudent->dob ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('dob') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Admission Date <span class="text-danger">*</span></label>
                            <input type="date" name="admission_date" class="form-control" placeholder="Enter Admission Date" 
                                value="{{ old('admission_date', $singleStudent->admission_date ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('admission_date') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control form-select" >
                                <option value="">--- Select Gender ---</option>
                                <option value="Male"
                                    {{ old('gender', $singleStudent->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female"
                                    {{ old('gender', $singleStudent->gender ?? '') == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        </div>


                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control form-select" >
                                <option value="">--- Select Status ---</option>
                                <option value="1"
                                    {{ old('status', $singleStudent->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0"
                                    {{ old('status', $singleStudent->status ?? '') == '0' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            <span class="text-danger">{{ $errors->first('status') }}</span>
                        </div>

                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Address (optional)</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                value="{{ old('address', $singleStudent->address ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        </div>
                       
                        <div class="col-md-6">
                            <label class="fs-4 mb-1">Profile Image</label>
                            <input type="file" name="profile_photo" class="form-control"
                                value="{{ old('profile_photo', $singleStudent->profile_photo ?? '') }}" />
                            <span class="text-danger">{{ $errors->first('profile_photo') }}</span>

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
