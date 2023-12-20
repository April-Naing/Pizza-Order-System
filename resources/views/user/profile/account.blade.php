@extends('user.layout.master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Account Info</h3>
                            </div>
                            <hr>
                            @if (session('updateSuccess'))
                                <div class="col-8 offset-2 mb-2 alert alert-success alert-dismissible fade show"
                                    role="alert">
                                    <i
                                        class="fa-solid fa-check-double me-2"></i><strong>{{ session('updateSuccess') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('user#accountChange', Auth::user()->id) }}" method="post"
                                novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-5 offset-1">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img class="img-thumbnail shadow-sm" src="{{ asset('image/default.png') }}">
                                            @else
                                                <img class="img-thumbnail shadow-sm"
                                                    src="{{ asset('image/default_2.png') }}">
                                            @endif
                                        @else
                                            <img class="img-thumbnail shadow-sm"
                                                src="{{ asset('storage/' . Auth::user()->image) }}">
                                        @endif

                                        <div class="form-group">
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <div class="">
                                            <button class="btn bg-dark text-white">Update<i
                                                    class="fa-regular fa-circle-right ms-2"></i></button>
                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror  "
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('name', Auth::user()->name) }}" placeholder="Enter admin name">
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
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                placeholder="Enter admin email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class=" control-label mb-1 ">Gender</label>
                                            <select name="gender" id=""
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option selected value="">Choose your gender</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10"
                                                placeholder="Enter admin address">{{ old('address', Auth::user()->address) }}</textarea>
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
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                placeholder="Enter admin phone number">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" class="form-control"
                                                aria-required="true" aria-invalid="false"
                                                value="{{ old('role', Auth::user()->role) }}" disabled>

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
@endsection
