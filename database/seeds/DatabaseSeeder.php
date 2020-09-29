<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(EntriesTableSeeder::class);
        // $this->call(DepartmentsTableSeeder::class);
        // $this->call(MajorsTableSeeder::class);
        // $this->call(StudentsTableSeeder::class);
    }
}
