<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReferralExport implements FromView
{

    public function __construct($referrals)
    {
        $this->referrals=$referrals;
    }

    public function view(): View
    {
        return view('siteadmin.referral-export', [
            'referrals' => $this->referrals
        ]);
    }
}
