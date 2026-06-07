<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        /* Admin::create([
            'national_id' => '222222222',
            'name' => 'مدير النظام',
            'email' => 'admin@test.com',
            'phone' => '0592222222',
            'password' => bcrypt('123456'),
        ]);*/

       Admin::create([
            'national_id' => '408087674',
            'name' => 'Suhaib',
            'email' => 'Suhaib@email.ps',
            'phone' => '0567853369',
           // 'password' => bcrypt('كلمة-السر'),
           'password'=>bcrypt('408087674'),
        ]);
    }
}
