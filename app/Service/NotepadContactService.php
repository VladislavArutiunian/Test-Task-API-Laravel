<?php

namespace App\Service;

use App\Http\Requests\StoreNotepadContactRequest;
use App\Http\Requests\UpdateNotepadContactRequest;
use App\Models\NotepadContact;

class NotepadContactService
{
    public function store(StoreNotepadContactRequest $request)
    {
        $data = $request->validated();
        return NotepadContact::firstOrCreate($this->checkAndModifyEntryData($data));
    }

    public function update(UpdateNotepadContactRequest $request, string $id)
    {
        $data = $request->validated();
        $note = NotepadContact::find($id);
        $note->update(
            $this->checkAndModifyEntryData($data)
        );
        return $note;
    }

    private function checkAndModifyEntryData(array $data): array
    {
        if (request()->hasFile('photo')) {
            $path = config('api.notepad_contacts.storage');
            $data['photo'] = request()->file('photo')->store($path, 'public');
        }

        if (isset($data['full_name'])) {
            $fullNameSplit = explode(' ', $data['full_name']);
            $data['first_name'] = $fullNameSplit[0];
            $data['last_name'] = $fullNameSplit[1];
            $data['patronymic'] = $fullNameSplit[2] ?? null;
            unset($data['full_name']);
        }
        return $data;
    }
}
