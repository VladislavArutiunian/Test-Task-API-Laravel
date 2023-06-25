<?php

namespace Database\Seeders;

use App\Models\ContactBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
         ContactBook::factory(10)->create();
    }
}
