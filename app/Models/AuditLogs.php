<?php

namespace App\Models;


class AuditLogs extends BaseModel
{
    protected $table = 'audit_logs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'actor_user_id',
        'actor_company_id',
        'action',
        'subject_type',
        'subject_id',
        'meta',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];
    
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'meta' => 'array',
    ];
    
    public $translatable = [

    ];

    public function actorUser()
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }

    public function actorCompany()
    {
        return $this->belongsTo(Companies::class, 'actor_company_id');
    }

    public function subject()
    {
        return $this->morphTo();
    }
}
