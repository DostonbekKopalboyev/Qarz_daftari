<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Payment extends Model
{
    use HasFactory,HasRoles;
    protected $fillable = [
        'costumer_id', 'user_id', 'quantity'
    ];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id','id');
    }

    public function costumer()
    {
       return $this->belongsTo(Costumer::class, 'costumer_id','id');
    }
}
