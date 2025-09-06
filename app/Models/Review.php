<?php

namespace App\Models;


class Review extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from_company_id',
        'to_company_id',
        'tender_id',
        'rating',
        'comment',
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

    public function fromCompany()
    {
        return $this->belongsTo(Companies::class, 'from_company_id');
    }

    public function toCompany()
    {
        return $this->belongsTo(Companies::class, 'to_company_id');
    }

    public function tender()
    {
        return $this->belongsTo(Tenders::class);
    }
}
