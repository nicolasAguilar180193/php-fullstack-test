<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'communes';
    protected $primaryKey = 'id_com';
    
    public function region() {
        return $this->belongsTo(Region::class, 'id_reg', 'id_reg');
    }
}
