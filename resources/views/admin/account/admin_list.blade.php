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
                                <h2 class="title-1">Admin List</h2>

                            </div>
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
                            <form action="{{route('admin#list')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search key..." value="{{ request('key')}}">
                                    <button type="submit" class="btn btn-primary text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                  <div class="row mt-2">
                        <div class="bg-white col-2 offset-10">
                            <h4 class="py-2"><i class="fa-sharp fa-solid fa-database"></i> -{{ $admin->total()}}   </h4>
                        </div>
                    </div>



                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($admin as $a)
                            <tr class="tr-shadow">
                                <td class="col-3">
                                    @if ($a->image == null)
                                      @if ($a->gender == 'male')
                                        <img class="img-thumbnail shadow-sm" src="{{asset('image/default.png')}}" >
                                      @else
                                        <img class="img-thumbnail shadow-sm" src="{{asset('image/default_2.png')}}" >
                                      @endif
                                    @else
                                      <img class="img-thumbnail shadow-sm" src="{{asset('storage/'.$a->image)}}" >
                                    @endif
                                    </td>
                                <td class="col-2">{{$a->name}}

                                </td>
                                <td>{{$a->email}}</td>
                                <td >{{$a->phone}}</td>
                                <td >{{$a->address}}</td>
                                <td >{{$a->gender}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if ($a->id == Auth::user()->id)

                                        @else
                                        {{-- <a href="{{route('admin#changeRole',$a->id)}}"  class="me-3">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Admin Role Change">
                                                <i class="fa-solid fa-toggle-off"></i>
                                            </button>
                                        </a> --}}
                                        <input type="hidden" class="userId" value="{{$a->id}}">
                                        <select name="" id="changeRole" class="me-3">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        <a href="{{route('adminlist#delete',$a->id)}}" class="me-3">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$admin->appends(request()->query())->links()}}
                        {{-- <div class="">


                        </div> --}}

                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('#changeRole').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("div");
                $userId = $parentNode.find('.userId').val();

                $data = {
                    'userId' : $userId ,
                    'status'  : $currentStatus
                }

                $.ajax({
                    type : 'get' ,
                    url : 'http://127.0.0.1:8000/admin/ajax/admin/changeRole',
                    data : $data ,
                    dataType : 'json'
                })
                location.reload()
            })
        })
    </script>
@endsection
