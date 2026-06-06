<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_name',
        'amount',
        'anonymous',
        'payment_method',
        'purpose',
        'receipt',
        'status',
        'appeal_id',
        'organization_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appeal()
{
    return $this->belongsTo(Appeal::class);
}



public function organization()
{
    return $this->belongsTo(Organization::class);
}
}
