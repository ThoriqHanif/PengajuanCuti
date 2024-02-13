<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;



class Permission extends SpatiePermission
{

    protected $table = 'permissions';

    protected $fillable =[
        'name',
        'alias',
        'menu_name',
        'guard_name'
    ];

    protected $guard_name = 'web';

    
}
