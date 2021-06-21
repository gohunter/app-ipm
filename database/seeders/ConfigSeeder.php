<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['config_name' => 'siteurl', 'config_value' => 'https://documento.ipm.com.pe'],
            ['config_name' => 'logourl', 'config_value' => 'https://ipm.com.pe/wp-content/uploads/2018/08/logo-ipm-mundo-mejor-1.png'],
            ['config_name' => 'logoqr', 'config_value' => ''],
        ];
        foreach ($items as $item) {
            \App\Models\Config::create($item);
        }
    }
}
