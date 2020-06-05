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
                                <h3 class="card-title">Users Edit</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="post" enctype="multipart/form-data" action="{{route('users.update',['id'=>$useredit->id])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputname">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$useredit->name}}" placeholder="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Gender</label>
                                        <select name="gender" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="male" {{$useredit->gender=='male'?'selected':''}}>Male</option>
                                            <option value="female" {{$useredit->gender=='female'?'selected':''}}>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Email</label>
                                        <input type="text" name="email" class="form-control" value="{{$useredit->email}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Mobile</label>
                                        <input type="text" name="mobile" class="form-control" value="{{$useredit->mobile}}" placeholder="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Address</label>
                                        <input type="text" name="address" class="form-control" value="{{$useredit->address}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Status</label>
                                        <select name="status" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$useredit->status==1?'selected':''}}>Active</option>
                                            <option value="0" {{$useredit->status==0?'selected':''}}>Inactive</option>
                                            <option value="2" {{$useredit->status==2?'selected':''}}>Block</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" value="{{$useredit->dob}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">City</label>
                                        <input type="text" name="city" class="form-control" value="{{$useredit->city}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">PinCode</label>
                                        <input type="text" name="pincode" class="form-control" value="{{$useredit->pincode}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Qualification</label>
                                        <select name="qualification" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="10th" @if($useredit->qualification=='10th'){{'10th'}}@endif>10th</option>
                                            <option value="12th" @if($useredit->qualification=='12th'){{'12th'}}@endif>10th</option>
                                            <option value="Diploma" @if($useredit->qualification=='Diploma'){{'Diploma'}}@endif>Diploma</option>
                                            <option value="Graduate" @if($useredit->qualification=='Graduate'){{'Graduate'}}@endif>Graduate</option>
                                            <option value="Post Graduate" @if($useredit->qualification=='Post Graduate'){{'Post Graduate'}}@endif>Post Graduate</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Referral Code</label>
                                        <input type="text" name="referred_code" class="form-control" value="{{$useredit->referral_code}}" placeholder="" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputimage">Referral By</label>
                                        <input type="text" name="referred_by" class="form-control" value="{{$useredit->referred_by}}" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Is Paid:</label>
                                        <select name="is_paid" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$is_paid==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$is_paid==0?'selected':''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Subscription Required</label>
                                        <select name="subscription_required" class="form-control" id="exampleInputistop" placeholder="">
                                            <option value="1" {{$useredit->subscription_required==1?'selected':''}}>Yes</option>
                                            <option value="0" {{$useredit->subscription_required==0?'selected':''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputistop">Subscription Expiry</label>
             {{--                        @if($useredit->subscription_expiry)
                                            {{

floor(((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) - (floor((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) / (365*60*60*24))) * 365*60*60*24)/ (30*60*60*24))

}}@endif--}}
                                        <select name="subscription_expiry" class="form-control" id="exampleInputistop"
                                                placeholder="">
                                            <option value="0">Dont Allow Access</option>
                                            <option value="1" {{floor(((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) - (floor((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) / (365*60*60*24))) * 365*60*60*24)/ (30*60*60*24))==1?'selected':''}}>Allowed For 1 Month
                                            </option>
                                            <option value="2" {{floor(((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) - (floor((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) / (365*60*60*24))) * 365*60*60*24)/ (30*60*60*24))==2?'selected':''}}>Allowed For 2 Month
                                            </option>
                                            <option value="3" {{floor(((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) - (floor((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) / (365*60*60*24))) * 365*60*60*24)/ (30*60*60*24))==3?'selected':''}}>Allowed For 3 Month
                                            </option>
                                            <option value="4" {{floor(((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) - (floor((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) / (365*60*60*24))) * 365*60*60*24)/ (30*60*60*24))==4?'selected':''}}>Allowed For 4 Month
                                            </option>
                                            <option value="5" {{floor(((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) - (floor((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) / (365*60*60*24))) * 365*60*60*24)/ (30*60*60*24))==5?'selected':''}}>Allowed For 5 Month
                                            </option>
                                            <option value="6" {{floor(((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) - (floor((abs((strtotime($useredit->subscription_expiry)) - (strtotime(date('Y-m-d', strtotime('-1 days', strtotime("now"))))))) / (365*60*60*24))) * 365*60*60*24)/ (30*60*60*24))==6?'selected':''}}>Allowed For 6 Month
                                            </option>
                                        </select>
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
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
