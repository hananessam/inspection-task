<?php

namespace Modules\Tenant\Database\Seeders;

use Modules\Tenant\Models\Tenant;
use Modules\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::create([
            'name' => 'Demo Tenant',
        ]);

        User::create([
            'name' => 'Tenant Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'tenant_id' => $tenant->id,
        ]);
    }
}
