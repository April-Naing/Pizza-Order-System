@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3"><i class="fa-solid fa-backward-fast mr-2"></i>Back to List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Product Form</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label  class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName')}}" class="form-control @error('pizzaName') is-invalid @enderror  " aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="control-label mb-1">Category Name</label>
                                    <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            <option value="">Choose Category Name</option>
                                        @foreach ($categories as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                @error('pizzaCategory')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" id="" cols="30" rows="10" class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Pizza Description"></textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="control-label mb-1">Image</label>
                                    <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number" value="" class="form-control @error('pizzaPrice') is-invalid @enderror  " aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price...">
                                @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="waitingTime" type="text" value="" class="form-control @error('waitingTime') is-invalid @enderror  " aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...">
                                @error('waitingTime')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fa-solid fa-circle-right"></i>
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
