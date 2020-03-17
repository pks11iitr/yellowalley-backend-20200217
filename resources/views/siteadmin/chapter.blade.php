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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Chapter Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>image</th>
                                    <th>Isactive</th>
                                    <th>Hastest</th>
                                    <th>Sequence No</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($chapters as $chapter)
                                    <tr>
                                        <td>{{$chapter->title}}</td>
                                        <td>{{$chapter->description}}</td>
                                        <td><img src="{{$chapter->image}}" height="50px" width="50px"/></td>
                                        <td>
                                            @if($chapter->isactive==1){{'Yes'}}
                                                @else{{'No'}}
                                                @endif
                                        </td>
                                        <td>
                                            @if($chapter->hastest==1){{'Yes'}}
                                            @else{{'No'}}
                                            @endif
                                        </td>
                                        <td>{{$chapter->sequence_no}}</td>
                                        <td><a href="{{route('chapter.edit',['id'=>$chapter->id])}}" class="btn btn-primary">Edit</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
