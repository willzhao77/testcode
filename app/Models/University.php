<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $table = 'universities';
    protected $fillable = ['name', 'webpages', 'domains', 'ttl', 'country_id'];
    public function country()
    {
        return $this->belongsTo(Country::class,  'id', 'country_id');
    }
}
