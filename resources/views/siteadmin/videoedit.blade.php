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
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Video Edit</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('video.update',['id'=>$videoedit->id])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputtitle">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$videoedit->name}}" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Image</label>
                                        <input type="file" name="image" class="form-control" id="exampleInputimage" placeholder="">
                                        <img src="{{$videoedit->image}}" height="100" width="200">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Video Url</label>
                                        <input type="file" name="video_url" class="form-control" id="exampleInputimage" placeholder=""><br>
                                        <td><a href="{{$videoedit->video_url}}" class="btn btn-warning">Video View</a></td>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Active</label>
                                        <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$videoedit->isactive==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$videoedit->isactive==0?'selected':''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputtitle">ChapterID</label>
                                        <select name="chapter_id" class="form-control" id="exampleInputistop" placeholder="">
                                            @foreach($chapters as $chapter)
                                                <option value="{{$chapter->id}}" {{$videoedit->chapter_id==$chapter->id?'selected':''}}>{{$chapter->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputdescription">Description</label>
                                        <textarea name="description" class="form-control" placeholder="Description">{{$videoedit->description}}</textarea>
                                    </div>
                                    <div  class="col-md-4">
                                        <label for="exampleInputistop">Sequence No</label>
                                        <input type="number" value="{{$videoedit->sequence_no}}" name="sequence_no" class="form-control" min="1" max="100">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
