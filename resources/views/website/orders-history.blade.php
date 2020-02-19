@extends('website.layout')

@section('mainbody')

    <div id="mainBody">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
                        <li class="active"> MY ORDER</li>
                    </ul>
                </div>
                <!-- Sidebar end=============================================== -->

                <div class="span9">
                    
                        @foreach($orders as $order)
						<table class="table table-bordered table-responsive" style="margin-bottom:10px;">
							<tbody>
                            <tr>
                                <th>{{'ORDER ID:'.$order->refid}}</th>
                                <td>Ordered on: {{date('D,d-M-Y', strtotime($order->updated_at))}}</td>
                                <td></td>
                                <td></td>
                                <td>Total:{{$order->total_paid}}</td>
                            </tr>
                            @foreach($order->details as $d)
                            <tr>
                                <td> <img width="60" src="{{$d->product->image}}" alt=""/></td>
                                <td>{{$d->product->name}}</td>
                                <td>{{$d->product->company}}</td>
                                <td>{{$d->quantity}}</td>
                                <td>{{$d->price}}</td>
                            </tr>
						</tbody>
                    </table>
                            @endforeach
                        @endforeach
                        
                </div>
            </div>
        </div>
	</div>
@endsection
