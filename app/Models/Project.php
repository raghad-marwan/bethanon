<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['name', 'description', 'budget', 'spent', 'status', 'start_date', 'end_date'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
