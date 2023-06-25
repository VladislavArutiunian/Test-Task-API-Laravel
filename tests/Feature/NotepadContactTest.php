<?php

namespace Tests\Feature;

use App\Models\NotepadContact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotepadContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test contacts are displayed correctly and pagination works
     */
    public function test_contacts_list_and_pagination_on_index(): void
    {
        $perPage = config('api.notepad_contacts.defaults.per_page_index');
        NotepadContact::factory(20)->create();

        $response = $this->get('/api/v1/notebook');

        $response->assertStatus(200);

        $response->assertJsonCount($perPage, 'data');
        $response->assertJsonPath('meta.last_page', 2);
    }

    /**
     * Test contact is displayed correctly and key data is obj
     */
    public function test_contact_is_displaying_on_show(): void
    {
        $contact = NotepadContact::factory(1)->create();
        $response = $this->get('/api/v1/notebook/' . $contact->first()->id);

        $response->assertStatus(200);
        $response->assertJsonIsObject('data');
    }

    /**
     * Test contact is updating correctly
     */
    public function test_contact_is_updating_on_update(): void
    {
        $contact = NotepadContact::factory(1)->create();

        $secondFullName = 'Name Surname Patronymic';

        $uri = '/api/v1/notebook/' . $contact->first()->id;
        $response = $this->post(
            $uri,
            [
            'full_name' => $secondFullName,
            'phone_number' => '35465785633',
            'email' => 'fkr@gmail.com',
            '_method' => 'PUT'
            ],
            ['Accept' => 'application/json']
        );

        $response->assertStatus(200);
        $response->assertJsonPath('data.full_name', $secondFullName);
    }
}
