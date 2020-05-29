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
                            <li class="breadcrumb-item active">Video</li>
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
                            <h3 class="card-title">Total Videos: {{$videos->total()}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Video Url</th>
                                    <th>Isactive</th>
                                    <th>ChapterID</th>
                                    <th>Description</th>
                                    <th>Sequence No</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($videos as $video)
                                    <tr>
                                        <td>{{$video->name}}</td>
                                        <td><img src="{{$video->image}}" height="50px" width="50px"/></td>
                                        <td>
                                        <a href="{{$video->video_url}}" class="btn btn-warning">View</a>
                                        </td>
                                        <td>
                                            @if($video->isactive==0){{'No'}}
                                            @else{{'Yes'}}
                                            @endif
                                        </td>
                                        <td>{{$video->chapter->title}}</td>
                                        <td>{{$video->description}}</td>
                                        <td>{{$video->sequence_no}}</td>
                                        <td><a href="{{route('video.edit',['id'=>$video->id])}}" class="btn btn-primary">Edit</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$videos->links()}}
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
