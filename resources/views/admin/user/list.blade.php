@extends('admin.layouts.master')
@section('title', 'User List Page')
@section('content')
<div class="main-content">
    <div class="row">
        <div class="col-5 offset-7 mb-2">
            @if (session('updateSuccess'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fa-solid fa-circle-check"></i> {{session('updateSuccess')}} 
                    <button type="button" class="close" data-dismiss="alert" >&times;</button>
                </div>   
            @endif
            @if (session('deleteSuccess'))
                <div class="alert alert-warning alert-dismissible fade show">
                    <i class="fa-solid fa-circle-check"></i> {{session('deleteSuccess')}} 
                    <button type="button" class="close" data-dismiss="alert" >&times;</button>
                </div>   
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">User List</h2>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2 mt-5">
                    <h3> Total - {{$users->total()}}</h3>
                    <table class="table table-data2" id="dataList">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($users as $user )
                            <tr>
                                <td> 
                                    @if($user->image == null)
                                        @if ($user->gender == 'male')
                                            <img src="{{asset('img/default_user.png')}}" alt="" class=" img-thumbnail" style="width:150px">
                                        @else
                                        <img src="{{asset('img/female_default.png')}}" alt="" class=" img-thumbnail" style="width:150px">    
                                        @endif 
                                    @else
                                        <img src="{{asset('storage/'.$user->image)}}" alt="" class="img-thumbnail" style="width:150px"> 
                                    @endif
                                </td>  
                                <input type="hidden" name="userId" id="userId" value="{{$user->id}}">
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td>
                                    <select name="" class="form-control statusChange" id="statusChange" style="width:120px">
                                        <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                        <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    </select>
                                </td>
                                <td>

                                    <div class="table-data-feature">
                                        <a href="{{route('user#edit', $user->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('user#delete', $user->id)}}">
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
                    <div class="mt-5">
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scriptSection')
    <script>
        
        $(document).ready(function(){

            //change status
            $('.statusChange').change(function() {

                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'role' : $currentStatus,
                    'userId' : $userId
                }

                console.log($data);

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/change/role',
                    data : $data,
                    dataType : 'json',
                })

                location.reload();
            })
        })
    </script>
@endsection