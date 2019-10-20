<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::connection('sqlite')->table('setting')->insert([
           ['key'=>'avatar','value'=>'','comment'=>'Default avatar'],
           ['key'=>'upload_domain','value'=>'','comment'=>'Default upload file domi'],
        ]);
    }
}
