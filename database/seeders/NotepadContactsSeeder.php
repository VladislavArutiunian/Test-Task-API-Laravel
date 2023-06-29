<?php

namespace Database\Seeders;

use App\Models\NotepadContact;
use Illuminate\Database\Seeder;

class NotepadContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
         NotepadContact::factory(10)->create();
    }
}
