@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
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
                        <a href=" {{route('category#createPage')}} ">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add category
                            </button>  
                        </a>
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
                    <p>Search Key : <span class="text-danger"> {{request('key')}} </span></p>
                    <p> <i class="fa-solid fa-database"></i> ( <span class="text-danger"> {{$categories->total()}}</span>)</p>
                    <form action=" {{route('category#list')}} " class="w-25">
                        @csrf
                        <div  class="input-group">
                            <input type="text" name="key" class="form-control" placeholder="Search..." value=" {{request('key')}} " >
                            <button class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                
                @if(count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Created Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr class="tr-shadow">
                                    <td>{{$category->category_id}}</td>
                                    <td>
                                    {{$category->name}}
                                    </td>
                                    <td>{{$category->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <a href=" {{route("category#delete", $category->category_id)}} ">
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
                    </div>
                @else
                    <p class="text-muted text-center mt-5">There is no categories.</p>
                @endif
                <!-- END DATA TABLE -->
            </div>
            <div class="mt-3">
                {{ $categories->links() }}
                {{-- {{$categories -> appends(request()->query())->links()}}; --}}
            </div>
        </div>
    </div>
</div>
@endsection