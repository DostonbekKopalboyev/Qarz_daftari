<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Debt extends Model
{
    use HasFactory,HasRoles;
    protected $fillable = [
        'costumer_id', 'user_id', 'product', 'quantity', 'end_day', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function costumer()
    {
        return $this->belongsTo(Costumer::class,'costumer_id','id');
    }


}
