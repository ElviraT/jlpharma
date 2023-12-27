<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesData = [
            ['id' => 1, 'name' => 'SuperAdmin'],
            ['id' => 3, 'name' => 'Farmacia'],
            ['id' => 4, 'name' => 'Drogueria'],
            ['id' => 5, 'name' => 'Cuentadante'],
            ['id' => 6, 'name' => 'JL'],
            ['id' => 7, 'name' => 'Vendedor'],
        ];

        foreach ($rolesData as $roleData) {
            Role::updateOrCreate(
                ['id' => $roleData['id']],
                [
                    'name' => $roleData['name'],
                    'guard_name' => 'web',
                    // Add 'created_at' and 'updated_at' if necessary
                ]
            );
        }

        $user = User::create([
            'name' => 'Desarrollo',
            'last_name' => 'Web',
            'dni' => '10000000',
            'email' => 'desarrollo@test.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('Admin'),
        ]);

        $role = Role::find(1); // Obtén el rol SuperAdmin por su ID

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}