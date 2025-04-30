<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Product extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'uuid',
        'category_id',
        'name',
        'price',
        'is_available',
        'attributes',
        'document',
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_available' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function transactions()
    {
        return $this->hasMany(\App\Models\Transaction::class);
    }
}
