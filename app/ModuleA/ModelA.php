<?php

namespace App\ModuleA;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelA extends Model
{
    use HasFactory;

    protected $appends = [
        'parsedImageUrl'
    ];

    protected $fillable = [
        'name',
    ];

    public function owner()
    {
        return $this->belongsTo('\App\Users\User');
    }

    public function scopeByOwner($query, $userId= null)
    {
        $id = $userId ?? \Auth::id();
        return $query->where('owner_id', $id);

    }
}
