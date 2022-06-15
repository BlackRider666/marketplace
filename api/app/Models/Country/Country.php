<?php

namespace App\Models\Country;

use App\Models\Country\Region\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function regions(): HasMany
    {
        return $this->hasMany(Region::class);
    }
}
