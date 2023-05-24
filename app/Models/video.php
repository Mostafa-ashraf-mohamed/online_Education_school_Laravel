<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;
    protected $table = 'videos';
    protected $primaryKey = 'V_id';
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'U_id');
    }
}
