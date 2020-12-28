<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => '123456',
            'name' => '系统管理员',
            'is_super' => true,
            'department_id' => '036',
        ]);

        User::create([
            'username' => 'test',
            'password' => '123456',
            'name' => '辅导员',
            'department_id' => '051',
        ])->roles()->sync([2]);
    }
}
