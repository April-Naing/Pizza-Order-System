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
                                <h2 class="title-1">Category List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href={{ route('category#createPage') }}>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8 alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-thumbs-up mr-2"></i><strong>{{session('deleteSuccess')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h5 class="text-secondary">Search key: <span class="text-danger">{{ request('key')}}</span></h5>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{route('category#list')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search key..." value="{{ request('key')}}">
                                    <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class=" col-1 offset-10 border rounded bg-white">
                            <h4 class="py-2"><i class="fa-sharp fa-solid fa-database me-1"></i>{{ $categories->total()}}</h4>
                        </div>
                    </div>

                    @if (count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Name</th>
                                    <th>Category Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                            <tr class="tr-shadow">
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->created_at->format('j-F-Y')}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{route('category#edit',$category->id)}}" >
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('category#delete',$category->id)}}">
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
                            {{$categories->appends(request()->query())->links()}}
                        </div>
                    </div>
                    @else
                    <h2 class="text-center my-3">There is no category here</h2>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection
