<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = Role::create(['name' => 'Admin']);
		$role2 = Role::create(['name' => 'Profesor']);

    //    Permission::create(['name' => 'admin.home']);
	
	Permission::create(['name' => 'admin.bloque.index']);
	Permission::create(['name' => 'admin.bloque.create']);
	Permission::create(['name' => 'admin.bloque.edit']);
	Permission::create(['name' => 'admin.bloque.destroy']);
	
	Permission::create(['name' => 'admin.categoria.index']);
	Permission::create(['name' => 'admin.categoria.create']);
	Permission::create(['name' => 'admin.categoria.edit']);
	Permission::create(['name' => 'admin.categooria.destroy']);
	
	Permission::create(['name' => 'admin.pregunta.index']);
	Permission::create(['name' => 'admin.pregunta.create']);
	Permission::create(['name' => 'admin.pregunta.edit']);
	Permission::create(['name' => 'admin.pregunta.destroy']);
    }
}
