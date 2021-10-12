<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Permission, Plan, Product, Profile, Role, Table, User};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $tenant = auth()->user()->tenant;

        $totalUsers =  User::where('tenant_id', $tenant->id)->count();
        //$totalTables = Table::where('tenant_id', $tenant->id)->count();
        $totalTables = Table::count();
        $totalCategory = Category::count();
        $totaProducts = Product::count();
        $totalPlano = Profile::count();
        $totalRoles = Role::count();
        $totalPlans = Plan::count();
        $totalPermission = Permission::count();

        return view(
            'admin.pages.home.index',
            compact(
                'totalUsers',
                'totalTables',
                'totalCategory',
                'totaProducts',
                'totalPlano',
                'totalRoles',
                'totalPlans',
                'totalPermission'
            )
        );
    }
}
