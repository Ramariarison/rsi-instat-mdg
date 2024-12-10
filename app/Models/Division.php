<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'service_id'];

    public function direction()
    {
        return $this->hasOneThrough(Direction::class, Service::class, 'id', 'id', 'service_id', 'direction_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }    
}
