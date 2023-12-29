<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;

    protected $table = 'customers';
    protected $primaryKey = ['dni', 'id_reg', 'id_com'];
    public $incrementing = false;

    protected $fillable = [
        'dni',
        'id_reg',
        'id_com',
        'email',
        'name',
        'last_name',
        'address',
        'date_reg',
        'status'
    ];

    public function region() {
        return $this->belongsTo(Region::class, 'id_reg', 'id_reg');
    }

    public function commune() {
        return $this->belongsTo(Commune::class, 'id_com', 'id_com');
    }
}
