<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'countries';
    protected $fillable = ['country', 'alphaCode'];

    public function universities()
    {
        return $this->hasMany(University::class, 'country_id', 'id');
    }
}
