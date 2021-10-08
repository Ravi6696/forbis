<?php

use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CountriesTableSeeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\SettingSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::FirstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::FirstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        Role::FirstOrCreate(['name' => 'pro-user', 'guard_name' => 'web']);
        $permissions = [
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            $admin->givePermissionTo($permission);
        }
        $user = User::firstOrNew(['email' => 'foorbisa@gmail.com']);
        $user->first_name = 'Foorbis';
        $user->mobile_no = '0123456789';
        $user->email = 'foorbisa@gmail.com';
        $user->password = Hash::make('admin@123');
        $user->save();
        $user->assignRole('admin');

        $user = User::firstOrNew(['email' => 'krupalidesai254@gmail.com']);
        $user->first_name = 'Krupali';
        $user->last_name = 'Desai';
        $user->mobile_no = '0123456789';
        $user->email = 'krupalidesai254@gmail.com';
        $user->password = Hash::make('123456');
        $user->save();
        $user->assignRole('user');

        $user = User::firstOrNew(['email' => 'krupalidesai2504@gmail.com']);
        $user->first_name = 'Krupali';
        $user->last_name = 'Pro';
        $user->mobile_no = '0123456789';
        $user->email = 'krupalidesai2504@gmail.com';
        $user->password = Hash::make('123456');
        $user->save();
        $user->assignRole('user');

        // $this->call(CategorySeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(PlanSeeder::class);
    }
}