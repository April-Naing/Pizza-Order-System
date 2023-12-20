@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>

                            @if (session('change'))
                            <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check-double me-2"></i><strong>{{session('change')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif


                            @if (session('notmatch'))
                            <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i><strong>{{session('notmatch')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <form action="{{route('admin#passwordChange')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label  class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password"  class="form-control @error('oldPassword') is-invalid @enderror  " aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                @error('oldPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"  class="form-control @error('newPassword') is-invalid @enderror  " aria-required="true" aria-invalid="false" placeholder="Enter new password">
                                @error('newPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror  " aria-required="true" aria-invalid="false" placeholder="Enter confirm password">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa-solid fa-key"></i>
                                        <span id="payment-button-amount">Change</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
