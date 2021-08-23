<?php

namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

class  TenantObserver
{
    /**
     * Handle "creating" event.
     *
     * @param  Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        $identify = app(ManagerTenant::class)->getTenantIdentify();
        if ($identify) {
            $model->tenant_id = $identify;
        }
    }
}
