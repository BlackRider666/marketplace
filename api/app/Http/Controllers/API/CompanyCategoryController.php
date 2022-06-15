<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CompanyCategory\CompanyCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyCategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'directions' => CompanyCategory::all(['id','name']),
        ]);
    }
}
