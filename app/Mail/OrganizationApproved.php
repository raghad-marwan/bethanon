<?php

namespace App\Mail;

use App\Models\Organization;
use Illuminate\Mail\Mailable;

class OrganizationApproved extends Mailable
{
    public $organization;

    public function __construct(Organization $organization)
    {
        $this->organization = $organization;
    }

    public function build()
    {
        return $this->subject('تم اعتماد مؤسستكم - صندوق مساعدة الناس')
            ->view('emails.organization-approved');
    }
}
