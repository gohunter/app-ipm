<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('documents');
        Storage::makeDirectory('documents');

        $items = [
            ['config_name' => 'siteurl', 'config_value' => 'https://documento.ipm.com.pe'],
            ['config_name' => 'logourl', 'config_value' => 'https://ipm.com.pe/wp-content/uploads/2018/08/logo-ipm-mundo-mejor-1.png'],
            ['config_name' => 'logoqr', 'config_value' => '3ed8193a936a64954ae00907307d92e3a435d846.png'],
            ['config_name' => 'jsonqr', 'config_value' => '{"data":"","config":{"body":"circle","eye":"frame13","eyeBall":"ball14","erf1":[],"erf2":[],"erf3":[],"brf1":[],"brf2":[],"brf3":[],"bodyColor":"#0056A9","bgColor":"#FFFFFF","eye1Color":"#0056A9","eye2Color":"#0056A9","eye3Color":"#0056A9","eyeBall1Color":"#0056A9","eyeBall2Color":"#0056A9","eyeBall3Color":"#0056A9","gradientColor1":"","gradientColor2":"","gradientType":"linear","gradientOnEyes":"true","logo":"","logoMode":"clean"},"size":1000,"download":"imageUrl","file":"svg"}']
        ];
        foreach ($items as $item) {
            \App\Models\Config::create($item);
        }
    }
}
