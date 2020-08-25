@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="strip_heading">Your Doubt</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 offset-md-3 py-3">
                    <form action="{{route('website.submit.doubt')}}" method="post">
                        @csrf
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms user_icon" name="name" placeholder=" " required>
                  <label>Name</label>
                </div>
              </div>

                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="phone" class="form-control form-blms call_icon"  name="mobile" placeholder=" " required maxlength="10">
                  <label>Mobile No.</label>
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
                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms email_icon"  name="subject" placeholder=" " required>
                  <label>Subject</label>
                </div>
              </div>

                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <textarea type="text" class="form-control form-blms email_icon"  name="description" placeholder=" " required></textarea>
                  <label>Your Doubt</label>
                </div>
              </div>

                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-blms btn-block">Submit</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
