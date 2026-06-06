<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Mail\Mailable;

class DonationRejected extends Mailable
{
    public $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        return $this->subject('تم رفض التبرع - صندوق مساعدة الناس')
            ->view('emails.donation-rejected');
    }
}
