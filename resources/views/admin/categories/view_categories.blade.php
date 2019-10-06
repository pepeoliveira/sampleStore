@extends('layouts.adminLayout.admin_design')
@section('content')

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ url('admin/dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="#" class="current">View Categories</a> </div>
            <h1>Categories</h1>
            @if(Session::has('flash_message_error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>   {!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>   {!! session('flash_message_success') !!}</strong>
                </div>
            @endif
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Categories</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Category Name</th>
                                    <th>Category Level</th>
                                    <th>Category URL</th>
                                    <th>Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr class="gradeX">
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent_id}}</td>
                                    <td>{{ $category->url }}</td>
                                    <td class="ml-5 text-center">
                                        <a href="{{ url('admin/edit-category/'.$category->id) }}"  class="btn btn-warning btn-mini">Edit</a>
                                        <a data-target="#delete-{{$category->id}}"  data-toggle="modal" class="btn btn-danger btn-mini">Delete</a>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade modal-sm" id="delete-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <button style="margin-right:15px; margin-top: 10px; color:red;" type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="modal-header">
                                                <p style="font-size:20px; margin-top:15px;" class="modal-title text-center"  id="exampleModalLabel"><b>DELETE CATEGORY: "{{$category->name}}"</b></p>

                                            </div>
                                            <div class="modal-body text-center">
                                                <p style="font-size: 30px; margin-top: 30px;">Are you sure?</p>
                                                <img style="width:100px; margin-bottom: 30px; margin-top: 30px;" class= "img-responsive" src="{{asset('/images/backend_images/delete.png')}}">
                                                <p style="font-size: 20px;">Do you really want to delete this CATEGORY?
                                                    <br> This process cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                <a class="btn btn-danger text-danger"  href="{{ url('admin/delete-category/'.$category->id) }}">
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
