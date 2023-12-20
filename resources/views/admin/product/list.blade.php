@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href={{ route('product#createPage') }}>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8 alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-thumbs-up mr-2"></i><strong>{{session('deleteSuccess')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h5 class="text-secondary">Search key: <span class="text-danger">{{ request('key')}}</span></h5>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{route('product#list')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search key..." value="{{ request('key')}}">
                                    <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-1 offset-10 border rounded bg-white">
                            <h4 class="py-2"><i class="fa-sharp fa-solid fa-database me-1"></i>{{ $pizzas->total()}}</h4>
                        </div>
                    </div>


                    @if (count($pizzas) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category Name</th>
                                    <th>Price</th>
                                    <th>View Count</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($pizzas as $p)
                            <tr class="tr-shadow">
                                <td class="col-3"><img class="img-thumbnail shadow-sm" src="{{asset('storage/'.$p->image)}}" ></td>
                                <td class="col-2">{{$p->name}}</td>
                                <td >{{$p->category_name}}</td>
                                <td >{{$p->price}}</td>
                                <td ><i class="fa-solid fa-eye"></i>{{$p->view_count}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('product#edit',$p->id)}}"  class="me-3">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('product#updatePage',$p->id)}}"  class="me-3">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#delete',$p->id)}}" class="me-3">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{$categories->links()}} --}}
                            {{$pizzas->appends(request()->query())->links()}}
                        </div>

                    </div>
                    @else
                    <div class="">
                        <h2>There is no product here</h2>
                    </div>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
