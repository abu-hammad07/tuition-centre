@extends('layouts.master')

@section('title')
    User List | T-Center
@endsection

@section('content')
    <!-- --------------------------------------------------- -->
    <!-- Main Start -->
    <!-- --------------------------------------------------- -->
    <div class="container-fluid">
        <!-- --------------------------------------------------- -->
        <!--  Users Start -->
        <!-- --------------------------------------------------- -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">User List</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">List</li>
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


        <!-- Search Form (Start) -->
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <form action="{{ route('userList') }}" method="GET" class="position-relative" title="Search">
                        <i
                            class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-5 ms-3 text-muted"></i>
                        <input type="text" name="s" class="form-control ps-5 fs-4 word-spacing-2px"
                            placeholder="Search..." value="{{ request('s') }}" autocomplete="off" />
                    </form>
                </div>
                <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end mt-3 mt-md-0">
                    <a href="{{ route('userAdd') }}" class="btn btn-info fw-semibold word-spacing-2px fs-4" title="Add">
                        <i class="ti ti-plus me-2"></i> Add
                    </a>
                </div>
            </div>
        </div>
        <!-- Search Form (End) -->


        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
                <h5 class="card-title fw-semibold mb-0 lh-sm">Details</h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">#</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">User</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Role</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                @if (Auth::user()->role == 'Admin')
                                    <th>
                                        <h6 class="fs-4 fw-semibold mb-0">Is Deleted</h6>
                                    </th>
                                @endif
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user_list as $key => $SingleUser)
                                @if ($SingleUser->is_deleted == null || Auth::user()->role == 'User')
                                    <tr>
                                        <td>
                                            <p class="mb-0 fw-normal">{{ $key + 1 }}</p>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center" title="{{ $SingleUser->username }}">
                                                <a href="#">
                                                    <img src="{{ URL::asset('dist/images/profile/user-1.jpg') }}"
                                                        class="rounded-circle card-hover" width="40" height="40" />
                                                </a>
                                                <div class="ms-3">
                                                    <h6 class="fs-4 fw-semibold mb-0">{{ $SingleUser->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 fw-normal" title="{{ $SingleUser->email }}">
                                                {{ $SingleUser->email }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($SingleUser->role == 'Admin')
                                                <span
                                                    class="badge bg-light-primary rounded-3 py-8 text-primary fw-semibold fs-2"
                                                    title="Admin">{{ $SingleUser->role }}</span>
                                            @else
                                                <span
                                                    class="badge bg-light-secondary rounded-3 py-8 text-secondary fw-semibold fs-2"
                                                    title="User">{{ $SingleUser->role }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($SingleUser->status == 1)
                                                <span
                                                    class="badge bg-light-success rounded-3 py-8 text-success fw-semibold fs-2"
                                                    title="Active">Active</span>
                                            @else
                                                <span
                                                    class="badge bg-light-danger rounded-3 py-8 text-danger fw-semibold fs-2"
                                                    title="Deactive">Deactive</span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->role == 'Admin')
                                            <td>
                                                <p class="mb-0 fw-normal" title="{{ $SingleUser->email }}">
                                                    @if (!empty($SingleUser->is_deleted))
                                                        {{ date('d-M-Y', strtotime($SingleUser->is_deleted)) }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>
                                            </td>
                                        @endif
                                        <!-- Action Buttons -->
                                        <td>
                                            <div class="action-btn d-flex gap-2 justify-content-center">
                                                <!-- Edit Button -->
                                                <a href="{{ route('userEdit', $SingleUser->id) }}" class="text-success">
                                                    <i class="ti ti-edit fs-6" title="Edit"></i>
                                                </a>
                                                <!-- Delete Button -->
                                                <a href="javascript:void(0)" class="text-dark delete-class-btn"
                                                    data-bs-toggle="modal" data-bs-target="#user"
                                                    data-url="{{ route('userDestroy', $SingleUser->id) }}">
                                                    <i class="ti ti-trash fs-6 text-danger" title="Delete"></i>
                                                </a>
                                                <!-- Status Checkbox (Active, Deactive) -->
                                                @if (Auth::user()->role == 'Admin')
                                                    <div class="form-check form-switch"
                                                        title="{{ $SingleUser->status == 1 ? 'Active' : 'Inactive' }}">
                                                        <input class="form-check-input enable_disable" type="checkbox"
                                                            data-id="{{ $SingleUser->id }}" data-action="user_status"
                                                            id="user_on_off_{{ $SingleUser->id }}"
                                                            {{ $SingleUser->status == 1 ? 'checked' : '' }}>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">No User Found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <!-- Start Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $user_list->links('pagination::bootstrap-4') }}
                </div>
                <!-- !End Pagination -->
            </div>
        </div>
        <!-- --------------------------------------------------- -->
        <!--  Users End -->
        <!-- --------------------------------------------------- -->
    </div>


    <!-- Delete Confirmation user Modal -->
    <div class="modal fade" id="user" tabindex="-1" aria-labelledby="userLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-light-danger">
                <div class="modal-body p-4">
                    <div class="text-center text-danger">
                        <i class="ti ti-hexagon-letter-x fs-7"></i>
                        <h4 class="mt-2">Delete!</h4>
                        <p class="mt-3">Are you sure you want to delete this user?</p>
                        <form id="userForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger my-2">Delete</button>
                        </form>
                        <button type="button" class="btn btn-light my-2" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('__messages')

    <script>
        $(document).ready(function() {
            $(".enable_disable").on("change", function() {
                let post_id = $(this).data("id");
                let status_set = $(this).prop("checked") ? "1" : "2"; // Enabled = 1, Disabled = 2
                $.ajax({
                    type: "POST",
                    url: "{{ route('ajax_status') }}",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: post_id,
                        value: status_set,
                        action_for: "user_status"
                    },
                    success: function(res) {
                        if (res.status === 1) {
                            Swal.fire({
                                icon: 'success',
                                html: '<p>' + res.message + '</p>',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: res.message,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            text: "Please try again.",
                        });
                    }
                });
            });
        });
    </script>


    <!-- JavaScript for Setting Delete URL -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let deleteButtons = document.querySelectorAll(".delete-class-btn");
            let deleteForm = document.getElementById("userForm");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    let deleteUrl = this.getAttribute("data-url");
                    deleteForm.setAttribute("action", deleteUrl);
                });
            });
        });
    </script>
@endsection
