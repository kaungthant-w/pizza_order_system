@extends('admin.layouts.master')
@section('title', 'Product List Page')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Products List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href=" {{route('product#createPage')}} ">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
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
                    <p> <i class="fa-solid fa-database"></i> ( <span class="text-danger"> {{$pizzas->total()}}</span>)</p>
                    <form action=" {{route('product#list')}}" class="w-25">
                        @csrf
                        <div  class="input-group">
                            <input type="text" name="key" class="form-control" placeholder="Search..." value="{{request('key')}}" >
                            <button class="btn btn-dark text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                
                    @if (count($pizzas) != 0)
                        <div class="table-responsive table-responsive-data2 mt-5">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pizzas as $p )
                                    <tr class="tr-shadow">
                                        <td> <img src="{{asset('storage/'.$p->image)}}" class=" img-thumbnail w-25 shadow-sm" alt=""> </td>
                                        <td class="col-2">{{$p->name}}</td>
                                        <td class="col-2">{{$p->price}}</td>
                                        <td class="col-2">{{$p->category_id}}</td>
                                        <td class="col-2" class="col-2">
                                            <i class="fa-solid fa-eye"></i> {{$p->view_count}}
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href=" {{route('product#edit', $p->id)}} ">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href=" {{route('product#delete', $p->id)}} ">
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
                    <p class="text-muted text-center mt-5">There is no Pizza Here...</p>

                    @endif
                <!-- END DATA TABLE -->
            </div>
            <div class="mt-3">
                {{ $pizzas->links() }}
                {{-- {{$categories -> appends(request()->query())->links()}}; --}}
            </div>
        </div>
    </div>
</div>
@endsection