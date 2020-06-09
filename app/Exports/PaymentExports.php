<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExports implements FromView
{

    public function __construct($payments)
    {
        $this->payments=$payments;
        //var_dump($this->payments);die;
    }

    public function view(): View
    {
        //die;
        return view('siteadmin.payment-export', [
            'payments' => $this->payments
        ]);
    }
}
