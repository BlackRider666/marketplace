<?php

namespace App\Models\User\UserCompany;

use App\Models\CompanyCategory\CompanyCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'site',
        'contact_person',
        'company_category_id',
        'desc',
    ];
    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CompanyCategory::class);
    }
}
