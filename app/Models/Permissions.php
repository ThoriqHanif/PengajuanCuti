<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory, HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'menu_name'
    ];

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'permission_role');
    }
}
