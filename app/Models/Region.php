<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use App\Values\StatusValue;

class Region extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'regions';
    protected $primaryKey = 'id_reg';

    protected $fillable = [
        'description',
        'status'
    ];

    public function communes() {
        return $this->hasMany(Commune::class, 'id_reg', 'id_reg');
    }
    
    public function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $this->statusTransform($value),
        );
    }

    private function statusTransform(string $value) 
    {
        return match ($value) {
            StatusValue::ACTIVE->value => 'Activo',
            StatusValue::INACTIVE->value => 'Inactivo',
            StatusValue::REMOVED->value => 'Eliminado',
            default => 'Activo',
        };
    }
}
