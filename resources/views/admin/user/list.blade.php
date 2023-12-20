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
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4>Total - {{ count($users)}}</h4>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                            @foreach ($users as $u)
                            <tr class="tr-shadow">
                                <td>@if ($u->image == null)
                                        @if ($u->gender == 'male')
                                          <img class="img-thumbnail shadow-sm" src="{{asset('image/default.png')}}" >
                                        @else
                                          <img class="img-thumbnail shadow-sm" src="{{asset('image/default_2.png')}}" >
                                        @endif
                                      @else
                                        <img class="img-thumbnail shadow-sm" src="{{asset('storage/'.$u->image)}}" >
                                      @endif
                                </td>
                                <td >{{$u->name}}
                                    <input type="hidden" name="" class="userId" value="{{$u->id}}">
                                </td>
                                <td >{{$u->email}}</td>
                                <td >
                                    {{$u->gender}}
                                </td>
                                <td class="">{{$u->phone}}</td>
                                <td >{{$u->address}} </td>
                                <td class="col-2">
                                    <select name="" class="roleChange">
                                        <option value="admin" @if ($u->role == 'admin' ) selected @endif>Admin</option>
                                        <option value="user" @if ($u->role == 'user' ) selected @endif>User</option>
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{$users->appends(request()->query())->links()}}
                        </div>

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
            $('.roleChange').change(function(){
                $status = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').val();

                $.ajax({
                    type : 'get' ,
                    url :  '/admin/user/ajax/list',
                    data : {'userId' : $userId , 'status' : $status},
                    dataType : 'json',
                })
                location.reload()

            })
        })
    </script>
@endsection


