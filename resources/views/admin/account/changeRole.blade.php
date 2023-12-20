@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                {{-- <a href="{{ route('product#list') }}" class="text-decoration-none">
                                    <i class="fa-solid fa-backward-step me-2 text-dark"></i>
                                </a> --}}
                                <i class="fa-solid fa-backward-step me-2 text-dark " onclick="history.back() "></i>
                            </div>

                                <form action="{{ route('admin#change',$account->id) }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-5 offset-1">
                                            @if ($account->image == null)
                                                <img class="img-thumbnail shadow-sm" src="{{ asset('image/default_1.png') }}">
                                            @else
                                            <img class="img-thumbnail shadow-sm" src="{{asset('storage/'.$account->image)}}" >
                                            @endif

                                            <div class="mt-3 ">
                                                <button class="btn bg-dark text-white col-12">Change<i class="fa-regular fa-circle-right ms-2"></i></button>
                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input id="cc-pament" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror  "
                                                    aria-required="true" aria-invalid="false" value="{{old('name',$account->name)}}" placeholder="Enter admin name" disabled>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input id="cc-pament" name="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror  "
                                                    aria-required="true" aria-invalid="false" value="{{old('email',$account->email)}}" placeholder="Enter admin email" disabled>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Role</label>
                                                <select name="role" id="" class="form-control">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                                {{-- <input id="cc-pament" name="role" type="text"
                                                    class="form-control"
                                                    aria-required="true" aria-invalid="false" value="{{old('role',$account->role)}}"> --}}
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Address</label>
                                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10"  placeholder="Enter admin address" disabled>{{old('address',$account->address)}} </textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Phone</label>
                                                <input id="cc-pament" name="phone" type="number"
                                                    class="form-control @error('phone') is-invalid @enderror  "
                                                    aria-required="true" aria-invalid="false" value="{{old('phone',$account->phone)}}"
                                                    placeholder="Enter admin phone number" disabled>
                                                @error('phone')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class=" control-label mb-1 ">Gender</label>
                                                <select name="gender" id="" class="form-control @error('gender') is-invalid @enderror" disabled>
                                                    <option selected>Choose your gender</option>
                                                    <option value="male" @if ($account->gender == 'male') selected @endif >Male</option>
                                                    <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>


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
