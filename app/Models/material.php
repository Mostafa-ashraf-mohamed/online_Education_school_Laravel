<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    use HasFactory;
    protected $table = 'materials';
    protected $primaryKey = 'M_id';
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'U_id');
    }
}
