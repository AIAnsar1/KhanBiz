<?php

namespace App\Models;


class TenderBids extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'amount',
        'currency',
        'message',
        'status',
        'tender_id',
        'supplier_company_id',
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

    public function tender()
    {
        return $this->belongsTo(Tenders::class);
    }

    public function supplierCompany()
    {
        return $this->belongsTo(Companies::class, 'supplier_company_id');
    }
}
