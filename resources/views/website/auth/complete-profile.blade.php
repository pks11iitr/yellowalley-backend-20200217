@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Fill your details</h4>
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
                        
                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms user_icon" name="name" placeholder=" " required>
                  <label>Name  (as will appear on certificate)</label>
                </div>
              </div>
                         
                           
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="email" class="form-control form-blms email_icon" name="email" placeholder=" " required>
                  <label>Email</label>
                </div>
              </div>
                            
                        </div>
                        <div class="form-group">
                            <input type="phone" class="form-control form-blms "  name="mobile" placeholder="Mobile Number" disabled value="{{$user->mobile}}" required>
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <select class="form-control form-blms" name="gender" required>
                               
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Other</option>
                            </select>
                  <label>Select Gender</label>
                </div>
              </div>
                          
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="date" class="form-control form-blms"  name="dob" placeholder=" " required>
                  <label>DOB</label>
                </div>
              </div>
                          
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms address_icon"  name="address" placeholder=" " required>
                  <label>Address</label>
                </div>
              </div>
                           
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms address_icon"  name="city" placeholder=" " required>
                  <label>City</label>
                </div>
              </div>
                          
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms address_icon"  name="pincode" placeholder=" " required>
                  <label>Pincode</label>
                </div>
              </div>
                           
                        </div>
                        <div class="form-group">

                        <div class="containermat">
                <div class="material-textfield">
                <select class="form-control form-blms" name="qualification">
                              
                                <option value="10th">10th</option>
                                <option value="12th">12th</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Graduate">Graduate</option>
                                <option value="Post Graduate">Male</option>
                            </select>
                  <label>Select Qualification</label>
                </div>
              </div>
                           
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms refrence_icon"  name="referred_by" placeholder=" ">
                  <label>Reference Id</label>
                </div>
              </div>
                           
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
