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
                            <li class="breadcrumb-item active">Payment</li>
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
                            <h3 class="card-title">Total Payments: {{$payments->total()}}</h3>
                        </div>
                        <div class="card-header">
                            <form>
                                <label>Select Status: </label>
                                <select name="status">
                                    <option value=""></option>
                                    <option value="pending" @if(request('staus')=='pending'){{'selected'}}@endif>Pending</option>
                                    <option value="paid" @if(request('staus')=='paid'){{'selected'}}@endif>Paid</option>
                                </select>
                                <button type="submit">Apply</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>UserID</th>
                                    <th>Ref Id</th>
                                    <th>Razorpay Id</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->user->name}}</td>
                                        <td>{{$payment->refid}}</td>
                                        <td>{{$payment->razorpay_order_id}}</td>
                                        <td>{{$payment->amount}}</td>
                                        <td>{{$payment->status}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$payments->links()}}
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
