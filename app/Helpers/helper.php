<?php

use App\Values\StatusValue;

function statusEnumToString(string $value) 
{
	return match ($value) {
		StatusValue::ACTIVE->value => 'Activo',
		StatusValue::INACTIVE->value => 'Inactivo',
		StatusValue::REMOVED->value => 'Eliminado',
		default => 'Activo',
	};
}