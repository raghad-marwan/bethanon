<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::create([
            'national_id' => '333333333',
            'name' => 'مؤسسة الإحسان',
            'email' => 'org@test.com',
            'phone' => '0593333333',
            'password' => bcrypt('123456'),
        ]);
    }
}
