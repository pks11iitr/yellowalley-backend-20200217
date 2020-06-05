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
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.change.password')}}">
                                @csrf


                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputimage">Mobile 1</label>
                                        <input type="text" class="form-control" id="exampleInputimage" placeholder="" disabled value="{{'xxxxxx'.substr($settings[0]->mobile, 6)}}"><a href="{{route('admin.send.otp',['id'=>$settings[0]->id])}}" class="btn btn-warning">Send OTP</a>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputimage">Mobile 2</label>
                                        <input type="text" class="form-control" id="exampleInputimage" placeholder="" disabled value="{{'xxxxxx'.substr($settings[1]->mobile, 6)}}">
                                        <a href="{{route('admin.send.otp',['id'=>$settings[1]->id])}}" class="btn btn-warning">Send OTP</a>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputimage">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputimage">Confirm Password</label>
                                        <input type="text" name="password_confirmation" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputimage">OTP</label>
                                        <input type="text" name="otp" class="form-control" id="exampleInputimage" placeholder="">
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
