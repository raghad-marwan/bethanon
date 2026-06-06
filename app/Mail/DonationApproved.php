<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Mail\Mailable;

class DonationApproved extends Mailable
{
    public $donation;

    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    public function build()
    {
        return $this->subject('تم تأكيد التبرع - صندوق مساعدة الناس')
            ->view('emails.donation-approved');
    }
}
