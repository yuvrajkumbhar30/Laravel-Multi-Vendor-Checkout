<?php
	
	namespace Database\Seeders;
	
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	use App\Models\User;
	use Illuminate\Support\Facades\Hash;
	
	class UserSeeder extends Seeder
	{
		/**
			* Run the database seeds.
		*/
		public function run(): void
		{
			User::create([
			'name' => 'Admin',
			'email' => 'admin@test.com',
			'password' => Hash::make('123456'),
			'role' => 'admin'
			]);
			
			User::create([
			'name' => 'Customer',
			'email' => 'customer@test.com',
			'password' => Hash::make('123456'),
			'role' => 'customer'
			]);
		}
	}
