@extends('admin.layouts.master')
@section('title', 'admin List Page')
@section('content')
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
                    <div class="table-data__tool-right">
                        {{-- <a href=" {{route('category#createPage')}} "> --}}
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add User
                            </button>  
                        {{-- </a> --}}
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>  
                    </div>
                </div>
                @if(session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                <div class="d-flex justify-content-between ">
                    <p>Search Key : <span class="text-danger"> {{ request('key')}} </span></p>
                    <p> <i class="fa-solid fa-database"></i> ( <span class="text-danger"> {{$admin->total()}}</span>)</p>
                    <form action=" {{route('admin#list')}} " method="get" class="w-25">
                        @csrf
                        <div  class="input-group">
                            <input type="text" name="key" class="form-control" placeholder="Search..." value=" {{request('key')}} " >
                            <button type="submit" class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="tr-shadow">
                                <input type="hidden" class="roleId" value="{{$a->id}}">
                                <td> 
                                    @if($a->image == null)
                                        @if ($a->gender == 'male')
                                            <img src="{{asset('img/default_user.png')}}" alt="" class=" img-thumbnail" style="width:150px">
                                        @else
                                        <img src="{{asset('img/female_default.png')}}" alt="" class=" img-thumbnail" style="width:150px">    
                                        @endif 
                                    @else
                                        <img src="{{asset('storage/'.$a->image)}}" alt="" class="img-thumbnail" style="width:150px"> 
                                    @endif
                                </td>    
                                <td>{{$a->name}}</td>
                                <td>{{$a->email}}</td>
                                <td>{{$a->phone}}</td>
                                <td>{{$a->gender}}</td>
                                <td>{{$a->address}}</td>
                                <td>
                                    @if (Auth::user()->id == $a->id)
                                    
                                    @else
                                        <select name="status" class="form-control roleChange" id="roleChange">
                                            <option value="admin" @if ($a->role == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if ($a->role == 'user') selected @endif>User</option>
                                        </select>    
                                    @endif
                                        
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        {{-- <a href="@if(Auth::user()->id == $a->id) # @else {{ route('admin#delete') }} @endif">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a> --}}
                                        @if(Auth::user()->id == $a->id)
                                        
                                        @else
                                        <a href="{{route('admin#changeRole', $a->id)}}">
                                            <button class="item mr-1" data-toggle="tooltip" data-placement="top" title="change admin role">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('admin#delete', $a->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="delete">
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
                </div>
            </div>
            <div class="mt-3">
                {{ $admin->links() }}
                {{-- {{$admin -> appends(request()->query())->links()}}; --}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function(){
                //change role
                $('.roleChange').change(function() {
                $currentRole = $(this).val();
                // console.log($currentRole);

                $parentNode = $(this).parents('tr');
                // console.log($parentNode)
                $roleId = $parentNode.find('.roleId').val();

                $data = {
                    'role' : $currentRole,
                    'roleId' : $roleId,
                }

                // console.log($data);

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/admin/ajax/change/role',
                    data : $data,
                    dataType : 'json',
                })
                // location.reload();
                window.location.href = "http://127.0.0.1:8000/admin/list";
            })
        });
    </script>
@endsection