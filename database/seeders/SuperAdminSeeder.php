<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password123')
        ]);

        $role = Role::firstOrCreate(['name' => 'admin']); // or create super-admin role
        $user->assignRole($role);
    }
}
