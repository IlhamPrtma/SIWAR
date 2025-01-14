<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;
use App\Models\Bahan;
use App\Models\Kategori;
use App\Models\Menu;
use App\Models\DetailMenu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'super admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ]
        ];
    
        DB::table('roles')->insert($data);


        $data = [
            [
                'name' => 'show dashboard',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit pesanan',
                'guard_name' => 'web'
            ],
            [
                'name' => 'tambah karyawan',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit karyawan',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit menu',
                'guard_name' => 'web'
            ]
        ];
    
        DB::table('permissions')->insert($data);


        $permissions = DB::table('permissions')->get();

        $superadmin = DB::table('roles')->where('name', 'super admin')->first();

        foreach ($permissions as $permission) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $permission->id,
                'role_id' => $superadmin->id,
            ]);
        }


        // add account data
        $superadmin = User::create([
            'nama' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'username' => 'sadmin1123',
            'password' => bcrypt('password'),
            'profile_photo' => 'photo-profile/1715432561_man3.jpg'
        ]);
    
        $superadmin->assignRole('super admin');
    
        $admin = User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin1123',
            'password' => bcrypt('password'),
            'profile_photo' => 'photo-profile/1715432656_man-taking-selfie.jpg'
        ]);
    
        $admin->assignRole('admin');



        $this->call([
            KategoriSeeder::class,
            MenuSeeder::class,
            // PesananSeeder::class,
            DetailMenuSeeder::class,
        ]);
    }
}
