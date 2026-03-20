<?php
	
	namespace Database\Seeders;
	
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	use App\Models\Product;
	
	class ProductSeeder extends Seeder
	{
		/**
			* Run the database seeds.
		*/
		public function run(): void
		{
			Product::create([
			'name' => 'iPhone 15',
			'price' => 80000,
			'stock' => 10,
			'vendor_id' => 1
			]);
			
			Product::create([
			'name' => 'Laptop Dell',
			'price' => 40000,
			'stock' => 1,
			'vendor_id' => 1
			]);
			
			Product::create([
			'name' => 'Nike Shoes',
			'price' => 3000,
			'stock' => 20,
			'vendor_id' => 2
			]);
			
			Product::create([
			'name' => 'T-Shirt',
			'price' => 1000,
			'stock' => 50,
			'vendor_id' => 2
			]);
			
		}
	}
