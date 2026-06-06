<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
  protected $fillable = [
    'title',
    'description',
    'target_amount',
    'current_amount',
    'is_urgent',
    'status',
    'organization_id',
];

public function organization()
{
    return $this->belongsTo(Organization::class);
}
}
