<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locations extends BaseModel
{
    use HasFactory;
    protected $table = "locations";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_code',
        'region',
        'city',
        'address',
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

    public function tenders()
    {
        return $this->hasMany(Tenders::class);
    }

}
