<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function getProductByTenantId(int $idTenant,  $categories)
    {
        return DB::table($this->table)
            ->join('category_product', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('products.tenant_id', $idTenant)
            ->where('categories.tenant_id', $idTenant)
            ->where(function ($query) use ($categories) {
                if ($categories != []) {
                    $query->whereIn('categories.uuid', $categories);
                }
            })
            ->select(
                'products.id',
                'products.uuid',
                'products.title',
                'products.flag',
                'products.price',
                'products.image',
                'products.tenant_id',
                'products.description',
                'products.created_at'
            )
            ->get();
    }

    public function getProductByUuid(string $uuid)
    {
        return DB::table($this->table)
            ->where('uuid', $uuid)
            ->first();
    }
}
