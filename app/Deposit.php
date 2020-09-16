<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'wallet_id', 'invested', 'percent', 'active', 'duration', 'accrue_times', 
    ];
}
