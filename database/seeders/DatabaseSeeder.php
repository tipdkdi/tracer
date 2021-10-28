<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $user = [
        //     [
        //         'name' => 'Bandrigo',
        //         'email' => 'admin@mail.com',
        //         'password' => bcrypt('1234qwer'),
        //     ],
        //     [
        //         'name' => 'Febi',
        //         'email' => 'febi@mail.com',
        //         'password' => bcrypt('1234qwer'),
        //     ],
        // ];
        // DB::table('users')->insert($user);
        DB::table('user_roles')->insert([
            ['nama_role' => 'administrator', "keterangan_role" => "admin utama"],
            ['nama_role' => 'alumni', "keterangan_role" => "alumni"]
        ]);
        $user = [
            [
                'user_role_id' => 1,
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('1234qwer'),
            ],
        ];
        DB::table('users')->insert($user);
    }
}
