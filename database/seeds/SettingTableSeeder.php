<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [[
            'id' => 1,
            'java_path' => 'C:\Program Files\Java\jdk1.8.0_111\bin',
            'created_at' => '2022-06-27 08:27:42',
            'updated_at' => '2022-06-27 08:27:42',
            'deleted_at' => NULL
        ]];

        Setting::insert($settings);
    }
}
