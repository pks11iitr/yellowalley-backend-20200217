<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Gender</th>
        <th>Address</th>
        <th>City</th>
        <th>Pincode</th>
        <th>Qualification</th>
        <th>Referral Code</th>
        <th>Referred By</th>
        <th>Payment Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->gender }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->pincode }}</td>
            <td>{{ $user->qualification }}</td>
            <td>{{ $user->referral_code }}</td>
            <td>{{ $user->referred_by }}</td>
            <td>{{ $user->payment_status??'pending' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
