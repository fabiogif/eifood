<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesByTentant(TenantFormRequest $request)
    {
        if (!$request->token_company) {
            return response()->json(['message', 'Token not found'], 404);
        }

        $categories = CategoryResource::collection($this->categoryService->getCategoriesByUuid($request->token_company));
        return $categories;
    }

    public function show($id)
    {

        $category = $this->categoryService->getCategoryById($id);

        if (!$category) {
            return response()->json(['message', 'Category not found'], 404);
        }

        return  new CategoryResource($category);
    }
}
