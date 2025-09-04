<?php

namespace App\Models;


class Tenders extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'title',
        'description',
        'budget_amount',
        'currency',
        'bids_deadline',
        'published_at',
        'closed_at',
        'visibility',
        'company_id',
        'category_id',
        'location_id',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'title' => 'string',
        'description' => 'string',
        'bids_deadline' => 'datetime',
        'published_at' => 'datetime',
        'closed_at' => 'datetime',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function location()
    {
        return $this->belongsTo(Locations::class);
    }

    public function bids()
{
    return $this->hasMany(TenderBids::class);
}
}
