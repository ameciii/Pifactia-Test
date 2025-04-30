<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Transaction extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'uuid',
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'details',
        'transaction_date',
        'is_completed',
    ];

    protected $casts = [
        'details' => 'array',
        'is_completed' => 'boolean',
        'transaction_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

  

}
