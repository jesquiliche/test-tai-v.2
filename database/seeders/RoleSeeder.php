<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'Admin']);
        $profesorRole = Role::create(['name' => 'Editor']);

        // Crear permisos
        Permission::create(['name' => 'admin.home']);
		Permission::create(['name' => 'admin.user.index']);
		Permission::create(['name' => 'admin.user.create']);
		Permission::create(['name' => 'admin.user.edit']);
		Permission::create(['name' => 'admin.user.destroy']);
        Permission::create(['name' => 'admin.bloque.index']);
        Permission::create(['name' => 'admin.bloque.create']);
        Permission::create(['name' => 'admin.bloque.edit']);
        Permission::create(['name' => 'admin.bloque.destroy']);
        Permission::create(['name' => 'admin.categoria.index']);
        Permission::create(['name' => 'admin.categoria.create']);
        Permission::create(['name' => 'admin.categoria.edit']);
        Permission::create(['name' => 'admin.categoria.destroy']);
        Permission::create(['name' => 'admin.pregunta.index']);
        Permission::create(['name' => 'admin.pregunta.create']);
        Permission::create(['name' => 'admin.pregunta.edit']);
        Permission::create(['name' => 'admin.pregunta.destroy']);

        // Asignar permisos a roles
        $adminRole->givePermissionTo([
            'admin.home',
            'admin.bloque.index',
            'admin.bloque.create',
            'admin.bloque.edit',
            'admin.bloque.destroy',
            'admin.categoria.index',
            'admin.categoria.create',
            'admin.categoria.edit',
            'admin.categoria.destroy',
            'admin.pregunta.index',
            'admin.pregunta.create',
            'admin.pregunta.edit',
            'admin.pregunta.destroy',
			'admin.user.index',
			'admin.user.create',
			'admin.user.edit',
			'admin.user.destroy'
        ]);

        $profesorRole->givePermissionTo([
            'admin.home',
            'admin.categoria.index',
            'admin.pregunta.index',
        ]);

        // Asignar roles a usuarios
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole($adminRole);

        $profesorUser = User::create([
            'name' => 'Profesor User',
            'email' => 'profesor@example.com',
            'password' => bcrypt('password'),
        ]);
        $profesorUser->assignRole($profesorRole);
    }
}
