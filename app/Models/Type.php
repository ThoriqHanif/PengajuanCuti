<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'types';

    protected $fillable = 
    [
        'name',
        'duration',
        'time',
        'duration_in_days',
    ];

    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
}
