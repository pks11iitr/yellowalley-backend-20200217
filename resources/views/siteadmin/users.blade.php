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
                            <li class="breadcrumb-item active">Users </li>
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
                        <div class="card-header">
                            <h3 class="card-title">Total Users: {{$users->total()}}</h3>
                        </div>
                        <div class="card-header">
                            <form>
                                <label>Search by name/email/mobile: </label>
                                <input type="text" name="user" value="{{request('user')}}">
                                <label>Date From:</label>
                                <input name="datefrom" type="date" value="{{request('datefrom')}}">
                                <label>Date To:</label>
                                <input name="dateto" type="date" value="{{request('dateto')}}">
                                <br>
                                <label for="exampleInputistop">Status</label>
                                <select name="status"  placeholder="">
                                    <option value="">All</option>
                                    <option value="1" {{request('status')==1?'selected':''}}>Active</option>
                                    <option value="0" {{!is_null(request('status')) && request('status')==0?'selected':''}}>Inactive</option>
                                    <option value="2" {{request('status')==2?'selected':''}}>Block</option>
                                </select>
                                <label for="exampleInputistop">Payment Status</label>
                                <select name="payment_status"  placeholder="">
                                    <option value="">All</option>
                                    <option value="paid" {{request('payment_status')=='paid'?'selected':''}}>Paid</option>
                                    <option value="pending" {{request('payment_status')=='pending'?'selected':''}}>Pending</option>
                                </select>
                                <button type="submit" class="btn">Apply</button>
                                <a class="btn">Export</a>
                            </form>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Registered On</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $s)
                                <tr>
                                    <td>{{$s->name}}</td>
                                    <td>{{$s->email}}/{{$s->mobile}}</td>
                                    <td>{{$s->address.''.$s->city.' '}}</td>
                                    <td>{{$s->status==0?'Inactive':($s->status==1?'Active':'Block')}}</td>
                                    @php
                                        $payment_status='pending';
                                        foreach($s->payments as $payment){
                                            if($payment->status=='paid'){
                                                $payment_status='paid';
                                                break;
                                            }
                                        }
                                    @endphp
                                    <td>{{$payment_status}}</td>
                                    <td>{{$s->created_at}}</td>
                                    <td><a href="{{route('users.edit',['id'=>$s->id])}}" class="btn btn-warning">Edit</a>&nbsp;&nbsp;<a href="{{route('users.delete',['id'=>$s->id])}}" class="btn btn-warning">Delete</a></td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$users->appends(request()->query())->links()}}
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
