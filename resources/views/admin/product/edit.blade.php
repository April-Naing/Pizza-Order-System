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
                            <div class="mb-2">
                                {{-- <a href="{{ route('product#list') }}" class="text-decoration-none">
                                    <i class="fa-solid fa-backward-step me-2 text-dark"></i>
                                </a> --}}
                                <i class="fa-solid fa-backward-step me-2 text-dark " onclick="history.back() "></i>
                            </div>

                            <div class="row">
                                <div class="col-3 offset-2">
                                     <img class="img-thumbnail shadow-sm" src="{{asset('storage/'.$pizza->image)}}" >
                                </div>

                                <div class="col-7">
                                    <div class="my-2 btn btn-danger d-block w-50 fs-5 ">{{$pizza->name}}</div>
                                        <span class="my-2 btn btn-dark"><i class="fa-solid fa-money-bills me-2 "></i>{{$pizza->price}}</span>
                                        <span class="my-2 btn btn-dark"><i class="fa-solid fa-clock me-2 "></i>{{$pizza->waiting_time}}</span>
                                        <span class="my-2 btn btn-dark"><i class="fa-solid fa-eye me-2 "></i>{{$pizza->view_count}}</span>
                                        <span class="my-2 btn btn-dark"><i class="fa-solid fa-expand me-2 "></i>{{$pizza->category_name}}</span>
                                        <span class="my-2 btn btn-dark"><i class="fa-solid fa-expand me-2 "></i>{{$pizza->created_at->format('j-F-Y')}}</span>

                                    <div class="my-2 fs-5"><i class="fa-solid fa-file-lines me-2"></i>Details</div>
                                        <div>- {{$pizza->description}}</div>
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
