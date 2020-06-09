<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Code Used</th>
        <th>Referance ID</th>
        <th>Razorpay ID</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Date & Time</th>
    </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
            <tr>
                <td>{{$payment->user->name??'-'}}</td>
                <td>{{$payment->user->referred_by??'-'}}</td>
                <td>{{$payment->refid??'-'}}</td>
                <td>{{$payment->razorpay_order_id}}</td>
                <td>{{$payment->amount}}</td>
                <td>{{$payment->status}}</td>
                <td>{{$payment->updated_at}}</td>
            </tr>
            @endforeach
    </tbody>
</table>
