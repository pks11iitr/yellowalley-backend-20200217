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
                    <form action="{{route('website.submit.doubt')}}" method="post">
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
                            <input type="text" class="form-control form-blms"  name="subject" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control form-blms"  name="description" placeholder="Description" required></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-blms btn-block">Submit Doubt</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
