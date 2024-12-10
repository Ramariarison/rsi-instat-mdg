<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'direction_id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

}

