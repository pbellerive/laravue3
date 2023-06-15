<?php

namespace App\Settings;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
}