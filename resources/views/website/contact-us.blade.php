@extends('website.layout')

@section('contents')

    <section class="breadcrumb m-0 bg-blms py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Contact Us</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3 bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-6 offset-md-3 py-3">
                    <h3>Please fill this form and we will get back to you shortly</h3>
                    <form action="{{route('website.contact.us')}}" method="post">
                        @csrf
                        <div class="form-group">

                        <div class="containermat">
                <div class="material-textfield">
                <input type="text" class="form-control form-blms" name="name" placeholder=" " required>
                  <label>Name</label>
                </div>
              </div>
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="email" class="form-control form-blms" name="email" placeholder=" " required>
                  <label>Email id</label>
                </div>
              </div>
                          
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <input type="phone" class="form-control form-blms"  name="mobile" placeholder=" " required maxlength="10">
                  <label>Mobile no</label>
                </div>
              </div>
                            
                        </div>
                        <div class="form-group">
                        <div class="containermat">
                <div class="material-textfield">
                <textarea type="text" class="form-control form-blms"  name="message" placeholder=" " required></textarea>
                  <label>Message</label>
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
