<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // 'role-list',
            // 'role-create',
            // 'role-edit',
            // 'role-delete',
            // 'user-list',
            // 'user-create',
            // 'user-edit',
            // 'user-delete',
            // 'supplier-list',
            // 'supplier-create',
            // 'supplier-edit',
            // 'supplier-delete',
            // 'product-list',
            // 'product-create',
            // 'product-edit',
            // 'product-delete',
            // 'product-category-list',
            // 'product-category-create',
            // 'product-category-edit',
            // 'product-category-delete',
            // 'product-type-list',
            // 'product-type-create',
            // 'product-type-edit',
            // 'product-type-delete',

        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
