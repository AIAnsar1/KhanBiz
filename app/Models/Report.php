<?php

namespace App\Models;


class Report extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reporter_company_id',
        'target_type',
        'target_id',
        'reason',
        'status',
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

    ];
    
    public $translatable = [

    ];

    public function reporterCompany()
    {
        return $this->belongsTo(Companies::class, 'reporter_company_id');
    }

    public function target()
    {
        return $this->morphTo();
    }
}
