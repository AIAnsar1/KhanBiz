<?php

namespace App\Models;


class Companies extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'legal_name',
        'brand_name',
        'tin',
        'country_code',
        'city',
        'address',
        'website',
        'verified_at',
        'about',
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
        'about' => 'array',
        'verified_at' => 'datetime',
    ];
    
    public $translatable = [

    ];

    public function tenders()
    {
        return $this->hasMany(Tenders::class);
    }
}
