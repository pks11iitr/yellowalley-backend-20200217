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
                            <li class="breadcrumb-item"><a href="#" >Home</a></li>
                            <li class="breadcrumb-item active">Doubts</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header ">
                            <h3 class="card-title">Total Contacts: {{$contacts->total()}}</h3>
                        </div>
                        <div class="card-header">
                            <form>
                                <label>Date From:</label>
                                <input name="datefrom" type="date" value="{{request('datefrom')}}">
                                <label>Date To:</label>
                                <input name="dateto" type="date" value="{{request('dateto')}}">
                                <label>Search:</label>
                                <input name="search" type="text" value="{{request('search')}}">
                                <button type="submit" class="btn" style="background-color: black;color: white">Apply</button>
                                <a type="submit" class="btn" style="background-color: black;color: white" href="{{route('contact.list')}}">Reset</a>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->mobile}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->message}}</td>
                                        <td>{{$contact->created_at}}</td>
                                        <td><a href="{{route('contact.delete',['id'=>$contact->id])}}" class="btn btn-warning">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    {{$contacts->links()}}
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
