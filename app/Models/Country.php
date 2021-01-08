<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'countries';

    public function university()
    {
        return $this->hasOne(University::class, 'country_id', 'id');
    }
}
