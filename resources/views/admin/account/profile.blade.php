@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    @if (session('updateSuccess'))
                        <div class="col-8 offset-2 mb-2 alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check-double me-2"></i><strong>{{session('updateSuccess')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null )
                                        @if (Auth::user()->gender == 'male')
                                            <img class="img-thumbnail shadow-sm" src="{{asset('image/default.png')}}" >
                                        @else
                                            <img class="img-thumbnail shadow-sm" src="{{asset('image/default_2.png')}}" >
                                        @endif
                                    @else
                                        <img class="img-thumbnail shadow-sm" src="{{asset('storage/'.Auth::user()->image)}}" >
                                    @endif
                                </div>

                                <div class="col offset-1">
                                    <h5 class="my-2"><i class="fa-solid fa-user-pen me-3 text-success"></i>{{Auth::user()->name}}</h5>
                                    <h5 class="my-2"><i class="fa-solid fa-envelope me-3 text-secondary"></i>{{Auth::user()->email}}</h5>
                                    <h5 class="my-2"><i class="fa-solid fa-address-card me-3 text-danger"></i>{{Auth::user()->address}}</h5>
                                    <h5 class="my-2"><i class="fa-solid fa-phone me-3 text-primary"></i>{{Auth::user()->phone}}</h5>
                                    <h5 class="my-2"><i class="fa-solid fa-calendar-days me-3 text-warning"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h5>
                                    <h5 class="my-2"><i class="fa-solid fa-venus-mars me-3 text-info"></i>{{Auth::user()->gender}}</h5>
                                </div>

                                <div class="col-3 offset-2">
                                    <a href="{{route('admin#edit')}}">
                                        <button class="btn bg-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
