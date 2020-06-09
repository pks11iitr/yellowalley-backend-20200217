<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Referral Code</th>
        <th>Number Of Referrals</th>
    </tr>
    </thead>
    <tbody>
    @foreach($referrals as $referral)
        <tr>
            <td>{{$referral->name}}</td>
            <td>{{$referral->referral_code}}</td>
            <td>@if(!empty($referral->referral_code))
                    {{$referral->referrals(request('datefrom'), request('dateto'))}}
                @else
                    0
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
