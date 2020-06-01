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
                            <li class="breadcrumb-item active">Users</li>
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
                                <h3 class="card-title">Users Add</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('users.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputname">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Gender</label>
                                        <select name="gender" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Email</label>
                                        <input type="text" name="email" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Mobile</label>
                                        <input type="text" name="mobile" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Address</label>
                                        <input type="text" name="address" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Status</label>
                                        <select name="status" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                            <option value="2">Block</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Date of Birth</label>
                                        <input type="text" name="dob" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">City</label>
                                        <input type="text" name="city" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">PinCode</label>
                                        <input type="text" name="pincode" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Qualification</label>
                                        <input type="text" name="qualification" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Referral By</label>
                                        <input type="text" name="referred_by" class="form-control" id="exampleInputimage" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Subscription Required</label>
                                        <select name="subscription_required" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Subscription Expiry</label>
                                        <select name="subscription_expiry" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1">Allowed For First Month</option>
                                            <option value="2">Allowed For Second Month</option>
                                            <option value="3">Allowed For Third Month</option>
                                            <option value="4">Allowed For Fourth Month</option>
                                            <option value="5">Allowed For Fifth Month</option>
                                            <option value="6">Allowed For Sixth Month</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
