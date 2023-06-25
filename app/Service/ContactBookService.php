<?php

namespace App\Service;

use App\Http\Requests\StoreContactBookRequest;
use App\Http\Requests\UpdateContactBookRequest;
use App\Models\ContactBook;

class ContactBookService
{
    public function store(StoreContactBookRequest $request)
    {
        $data = $request->validated();
        return ContactBook::firstOrCreate($this->checkAndModifyEntryData($data));
    }

    public function update(UpdateContactBookRequest $request, string $id)
    {
        $data = $request->validated();
        $note = ContactBook::find($id);
        $note->update(
            $this->checkAndModifyEntryData($data)
        );
        return $note;
    }

    private function checkAndModifyEntryData(array $data): array
    {
        if (request()->hasFile('photo')) {
            $data['photo'] = request()->file('photo')->store('entries_photo');
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
