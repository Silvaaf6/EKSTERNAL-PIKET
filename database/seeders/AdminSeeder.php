<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $create_karyawan = Permission::create(['name' => 'create_karyawan']);
        $edit_karyawan = Permission::create(['name' => 'edit_karyawan']);
        $read_karyawan = Permission::create(['name' => 'read_karyawan']);
        $delete_karyawan = Permission::create(['name' => 'delete_karyawan']);

        $create_piket = Permission::create(['name' => 'create_piket']);
        $edit_piket = Permission::create(['name' => 'edit_piket']);
        $read_piket = Permission::create(['name' => 'read_piket']);
        $delete_piket = Permission::create(['name' => 'delete_piket']);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo($read_karyawan, $create_piket);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($create_karyawan, $edit_karyawan, $delete_karyawan, $read_piket);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]); 

        $user->assignRole('admin');
    }
}
