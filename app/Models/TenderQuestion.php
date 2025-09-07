<?php

namespace App\Models;


class TenderQuestion extends BaseModel
{
    protected $table = "tender_questions";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tender_id',
        'author_company_id',
        'question',
        'answer',
        'answered_at',
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

    public function authorCompany()
    {
        return $this->belongsTo(Companies::class, 'author_company_id');
    }
}
