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
                            <li class="breadcrumb-item active">Banner</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Banner Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{$banners->appends(request()->query())->links()}}
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Banner Image</th>
                                    <th>Isactive</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $bann)
                                    <tr>
                                        <td><img src="{{$bann->doc_path}}" height="50px" width="50px"/></td>
                                        <td>{{$bann->isactive}}</td>
                                        <td><a href="{{route('banners.edit',['id'=>$bann->id])}}" class="btn btn-warning">Edit</a></td>
                                        <td><a href="{{route('banners.delete',['id'=>$bann->id])}}" class="btn btn-warning">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$banners->appends(request()->query())->links()}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
