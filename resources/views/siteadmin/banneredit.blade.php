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
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Banner Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('banners.update',['id'=>$banner->id])}}">
                            @csrf


                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="exampleInputimage">Banner Image</label>
                                    <input type="file" name="doc_path" class="form-control" id="exampleInputimage"
                                    placeholder="">
                                    <image src="{{$banner->doc_path}}" height="100" width="200">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputistop">Is Active</label>
                                    <select name="isactive" class="form-control" id="exampleInputistop" placeholder="">
                                      <option  selected="selected" value="1" {{$banner->isactive==1?'selected':''}}>Yes</option>
                                          <option value="0" {{$banner->isactive==0?'selected':''}}>No</option>
                                    </select>
                                </div>

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
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
