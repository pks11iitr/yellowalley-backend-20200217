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
                            <input type="text" class="form-control form-blms" name="name" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-blms" name="email" placeholder="Email Id" required>
                        </div>
                        <div class="form-group">
                            <input type="phone" class="form-control form-blms"  name="mobile" placeholder="Mobile Number" required maxlength="10">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control form-blms"  name="message" placeholder="Message" required></textarea>
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
