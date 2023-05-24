<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $primaryKey = 'U_id';
    public function videos()
    {
        return $this->hasMany(video::class, 'U_id');
    }

    public function materials()
    {
        return $this->hasMany(material::class, 'U_id');
    }
}
