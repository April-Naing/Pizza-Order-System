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
                            <div class="">
                                <a href="{{route('product#list')}}"><i class="fa-solid fa-arrow-left text-black"></i></a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Update</h3>
                            </div>
                            <hr>
                                <form action="{{ route('product#update') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-5 offset-1">
                                            <div class="">
                                                <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                                            </div>
                                            <img class="img-thumbnail shadow-sm" src="{{asset('storage/'.$pizza->image)}}" >
                                            <div class="form-group">
                                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                                @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                   {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="">
                                                <button class="btn bg-dark text-white">Update<i class="fa-regular fa-circle-right ms-2"></i></button>
                                            </div>

                                        </div>

                                        <div class="col-6">

                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input id="cc-pament" name="pizzaName" type="text"
                                                    class="form-control @error('pizzaName') is-invalid @enderror  "
                                                    aria-required="true" aria-invalid="false" value="{{old('pizzaName',$pizza->name)}}" placeholder="Enter admin pizzaName">
                                                @error('pizzaName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class=" control-label mb-1 ">Category Name</label>
                                                <select name="pizzaCategory" id="" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                    <option selected>Choose Category</option>
                                                    @foreach ($category as $c)
                                                        <option value="{{ $c->id}}" @if($c->id == $pizza->category_id) selected @endif>{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Description</label>
                                                <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10"  placeholder="Enter admin pizzaDescription" >{{old('pizzaDescription',$pizza->description)}}</textarea>
                                                @error('pizzaDescription')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Price</label>
                                                <input id="cc-pament" name="pizzaPrice" type="number"
                                                    class="form-control @error('pizzaPrice') is-invalid @enderror  "
                                                    aria-required="true" aria-invalid="false" value="{{old('pizzaPrice',$pizza->price)}}"
                                                    placeholder="Enter pizza pizzaPrice">
                                                @error('pizzaPrice')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Waiting Time</label>
                                                <input id="cc-pament" name="waitingTime" type="number"
                                                    class="form-control @error('waitingTime') is-invalid @enderror  "
                                                    aria-required="true" aria-invalid="false" value="{{old('waitingTime',$pizza->waiting_time)}}"
                                                    placeholder="Enter pizza waitingTime">
                                                @error('waitingTime')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label mb-1">View Count</label>
                                                <input id="cc-pament" name="viewCount" type="text"
                                                    class="form-control"
                                                    aria-required="true" aria-invalid="false" value="{{old('viewCount',$pizza->view_count)}}" disabled>

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
