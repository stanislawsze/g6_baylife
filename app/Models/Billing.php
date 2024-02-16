<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'customer_id', 'amount', 'is_payed', 'billing_name'
    ];

    protected $casts = [
        'id' => 'integer',
        'amount' => 'integer',
        'customer_id' => 'integer',
        'is_payed' => 'boolean',
        'billing_name' => 'string'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
