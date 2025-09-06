<?php

namespace App\Models;


class SubScription extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'plan_id',
        'starts_at',
        'ends_at',
        'remaining_bids',
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

    public function company()
    {
        return $this->belongsTo(Companies::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
