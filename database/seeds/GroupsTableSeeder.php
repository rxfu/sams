<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'slug' => 'bachelor',
            'name' => '本科生',
        ]);

        Group::create([
            'slug' => 'master',
            'name' => '研究生',
        ]);
    }
}
