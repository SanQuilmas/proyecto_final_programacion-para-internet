<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Libro;
use App\Models\ISBN;
use App\Models\Autor;

class LibroSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Libro::factory()
			->count(3)
			->has(Autor::factory()->count(3)->has(Libro::factory()->count(1)->has(ISBN::factory()->count(2))))
			->has(ISBN::factory()->count(3))
			->create();
	}
}
