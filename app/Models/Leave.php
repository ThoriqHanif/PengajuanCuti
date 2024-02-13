<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $table = 'leaves';

    protected $dates = ['start_date', 'end_date'];

    protected $fillable = [
        'code',
        'user_id',
        'type_id',
        'start_date',
        'end_date',
        'duration',
        'reason',
        'status_manager',
        'status_coo',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function coo()
    {
        return $this->belongsTo(User::class, 'coo_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($leave) {

            $userInitials = strtoupper(substr($leave->user->full_name, 0, 2));
            $typeInitials = strtoupper(substr($leave->type->name, 0, 2));
            $startDate = date('d', strtotime($leave->start_date));
            $endDate = date('d', strtotime($leave->end_date));

            $leave->code = $userInitials . $startDate . $typeInitials . $endDate;
            $leave->slug = Str::slug($leave->code);
        });

        static::updating(function ($leave) {
    
            $userInitials = strtoupper(substr($leave->user->full_name, 0, 2));
            $typeInitials = strtoupper(substr($leave->type->name, 0, 2));
            $startDate = date('d', strtotime($leave->start_date));
            $endDate = date('d', strtotime($leave->end_date));
    
            $leave->code = $userInitials . $startDate . $typeInitials . $endDate;
            $leave->slug = Str::slug($leave->code);
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'code'
            ]
        ];
    }
}
