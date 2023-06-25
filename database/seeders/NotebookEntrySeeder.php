<?php

namespace Database\Seeders;

use App\Models\NotebookEntry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotebookEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
         NotebookEntry::factory(10)->create();
    }
}
