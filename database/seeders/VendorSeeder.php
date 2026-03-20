<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::create(['name' => 'Vendor A']);
		Vendor::create(['name' => 'Vendor B']);
		Vendor::create(['name' => 'Vendor C']);
		Vendor::create(['name' => 'Vendor D']);
    }
}
