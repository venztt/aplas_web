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
        // untuk windows
        // $settings = [[
        //     'id' => 1,
        //     'java_path' => 'C:\Program Files\Java\jdk1.8.0_111\bin',
        //     'created_at' => '2022-06-27 08:27:42',
        //     'updated_at' => '2022-06-27 08:27:42',
        //     'deleted_at' => NULL
        // ]];

        //untuk linux
        $settings = [[
            'id' => 1,
            'java_path' => '/usr/bin/java',
            'java_junit_path' => '/home/noc/junit-platform-console-standalone-1.9.2.jar',
            'created_at' => '2022-06-27 08:27:42',
            'updated_at' => '2022-06-27 08:27:42',
            'deleted_at' => NULL
        ]];

        Setting::insert($settings);
    }
}
