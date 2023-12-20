@extends('admin.layout.master')

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
                        <h4>Total - {{ count($messages)}}</h4>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                            @foreach ($messages as $m)
                            <tr class="tr-shadow">
                                <td >{{$m->name}}</td>
                                <td >{{$m->email}}</td>
                                <td >
                                    {{$m->message}}
                                </td>
                                <td>
                                    <a href="{{route('admin#messageDelete',$m->id)}}" class="me-3">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="fa-solid fa-square-minus"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{$messages->appends(request()->query())->links()}}
                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
