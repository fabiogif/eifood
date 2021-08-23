<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TableResource;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    protected $tableService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function tablesByTenant(TenantFormRequest $request)
    {
        if (!$request->token_company) {
            return response()->json(['message', 'Token not found'], 404);
        }

        $tables = TableResource::collection($this->tableService->getTableByTenantUuid($request->token_company));
        return $tables;
    }

    public function show($uuid)
    {
        $table = $this->tableService->getTableByUuid($uuid);
        if (!$table) {
            return response()->json(['message', 'Table not found'], 404);
        }

        return  new TableResource($table);
    }
}
