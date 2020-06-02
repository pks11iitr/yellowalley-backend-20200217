@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Sign Up</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 offset-md-3 py-3">
                    <form action="{{route('website.complete.profile', ['code'=>$code])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-blms" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-blms" name="email" placeholder="Email Id" required>
                        </div>
                        <div class="form-group">
                            <input type="phone" class="form-control form-blms"  name="mobile" placeholder="Mobile Number" disabled value="{{$user->mobile}}" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control form-blms" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control form-blms"  name="dob" placeholder="DOB" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-blms"  name="address" placeholder="Address" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-blms"  name="city" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-blms"  name="pincode" placeholder="Pincode" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control form-blms" name="qualification">
                                <option value="" required>Select Qualification</option>
                                <option value="10th">10th</option>
                                <option value="12th">12th</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Graduate">Graduate</option>
                                <option value="Post Graduate">Male</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-blms"  name="referred_by" placeholder="Reference Id">
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
