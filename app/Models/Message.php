<?php

namespace App\Models;


class Message extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'thread_type',
        'thread_id',
        'from_company_id',
        'from_user_id',
        'body',
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

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'owner');
    }
}
