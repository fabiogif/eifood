<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ProductApiController extends Controller
{
    protected $productService;


    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function productsByTenant(TenantFormRequest $request)
    {

        if (!$request->token_company) {
            return response()->json(['message', 'Token not found'], 404);
        }
        $products = $this->productService->getProductsByTenantUuid(
            $request->token_company,
            $request->get('categories', array())
        );
        return ProductResource::collection($products);
    }

    public function show(TenantFormRequest $request, $flag)
    {
        $products = $this->productService->getProductByFlag($flag);

        if (!$products) {
            return response()->json(['message', 'Product not found'], 404);
        }

        return  new ProductResource($products);
    }
}
