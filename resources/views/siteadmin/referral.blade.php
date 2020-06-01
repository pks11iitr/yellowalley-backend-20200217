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
                            <li class="breadcrumb-item active">Referral </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Referral Table</h3>
                        </div>
                        <div class="card-header">
                            <form>
                                <label>Search by name: </label>
                                <input type="text" name="user" value="{{request('user')}}">
                                <label>Date From:</label>
                                <input name="datefrom" type="date" value="{{request('datefrom')}}">
                                <label>Date To:</label>
                                <input name="dateto" type="date" value="{{request('dateto')}}">
                                <button type="submit">Apply</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Referral Code</th>
                                    <th>Number of Referrals</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($referrals as $referral)
                                    <tr>
                                        <td>{{$referral->name}}</td>
                                        <td>{{$referral->referral_code}}</td>
                                        <td>@if(!empty($referral->referral_code))
                                            <a href="{{route('users.list', ['rcode'=>$referral->referral_code])}}" target="_blank">{{$referral->referrals(request('datefrom'), request('dateto'))}}</a>
                                            @else
                                                0
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$referrals->links()}}
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
