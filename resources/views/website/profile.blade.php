@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Profile</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 offset-md-3 py-3">
                    <form action="{{route('website.profile')}}" method="post">
                        @csrf
                        <div class="form-group">
                        <label for="" class="my_lbl">Referral ID</label>
                            <input type="text" class="form-control form-blms"  name="referred_by" placeholder="Referral ID" value="{{$user->referral_code}}" disabled>
                        </div>
                        <div class="form-group">
                        <label for="" class="my_lbl">Name</label>
                            <input type="text" class="form-control form-blms" name="name" placeholder="Name" value="{{$user->name}}" disabled>
                        </div>
                        <div class="form-group">
                        <label for="" class="my_lbl">Email</label>
                            <input type="text" class="form-control form-blms" name="email" placeholder="Email Id" value="{{$user->email}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="" class="my_lbl">Mobile No.</label>
                            <input type="phone" class="form-control form-blms"  name="mobile" placeholder="Mobile Number" disabled value="{{$user->mobile}}">
                        </div>
                        <div class="form-group">
                        <label for="" class="my_lbl">Gender</label>
                            <select class="form-control form-blms" name="gender" required>

                                <option value="">Select Gender</option>
                                <option value="male" @if($user->gender=='male'){{'selected'}}@endif>Male</option>
                                <option value="female" @if($user->gender=='female'){{'selected'}}@endif>Female</option>
                                <option value="others" @if($user->gender=='others'){{'selected'}}@endif>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="" class="my_lbl">DOB</label>
                            <input type="text" class="form-control form-blms"  name="dob" placeholder="yyyy-mm-dd" required value="{{$user->dob}}" id="date-picker">
                        </div>

                        <div class="form-group">
                            <label for="" class="my_lbl">Address</label>
                            <input type="text" class="form-control form-blms"  name="address" placeholder="Address" required value="{{$user->address}}">
                        </div>
                        <div class="form-group">
                        <label for="" class="my_lbl">City</label>
                            <input type="text" class="form-control form-blms"  name="city" placeholder="City" required value="{{$user->city}}">
                        </div>
                        <div class="form-group">
                        <label for="" class="my_lbl">Pincode</label>
                            <input type="text" class="form-control form-blms"  name="pincode" placeholder="Pincode" required value="{{$user->pincode}}">
                        </div>
                        <div class="form-group">
                        <label for="" class="my_lbl">Qualification</label>
                            <select class="form-control form-blms" name="qualification">
                                <option value="" required>Select Qualification</option>
                                <option value="10th" @if($user->qualification=='10th'){{'selected'}}@endif>10th</option>
                                <option value="12th" @if($user->qualification=='12th'){{'selected'}}@endif>12th</option>
                                <option value="Diploma" @if($user->qualification=='Diploma'){{'selected'}}@endif>Diploma</option>
                                <option value="Graduate" @if($user->qualification=='Graduate'){{'selected'}}@endif>Graduate</option>
                                <option value="Post Graduate" @if($user->qualification=='Post Graduate'){{'selected'}}@endif>Male</option>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-blms btn-block">Continue</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $( "#date-picker" ).datepicker({
                dateFormat: "yy-mm-dd",
                changeYear:true
            });
        });
//new
    </script>
@endsection

