@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Chapter</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Chapter Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('chapter.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputtitle">Title</label>
                                    <input type="text" name="title" class="form-control" id="exampleInputtitle" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputdescription">Description</label>
                                    <textarea name="description" class="form-control" id="exampleInputdescription" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputimage">Image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputimage" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputistop">Is Active</label>
                                    <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputistop">Hastest</label>
                                    <select name="hastest" class="form-control" id="exampleInputistop" placeholder="">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div  class="col-md-4">
                                    <label for="exampleInputistop">Sequence No</label>
                                    <input type="number" id="exampleInputistop" name="sequence_no" class="form-control" min="1" max="100">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
    @endsection
