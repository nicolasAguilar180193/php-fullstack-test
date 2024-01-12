<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Commune;
use App\Values\StatusValue;

class RegionCommuneRule implements ValidationRule
{
    protected $region_id;
    
    public function __construct(string $region_id) 
    {
        $this->region_id = $region_id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $commune = Commune::where('id_com', $value)
            ->where('id_reg', $this->region_id)
            ->where('status', StatusValue::ACTIVE->value)
            ->first();

        if (!$commune) {
            $fail('The commune does not belong to the region.');
        }
    }
}
