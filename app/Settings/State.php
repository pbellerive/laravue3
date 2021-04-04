<?php

namespace App\Settings;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class State extends Model implements TranslatableContract
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'country_id'
    ];

    public $translatedAttributes = ['name'];
}
