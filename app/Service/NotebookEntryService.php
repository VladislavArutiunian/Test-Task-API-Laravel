<?php

namespace App\Service;

use App\Http\Requests\StoreNotebookEntryRequest;
use App\Http\Requests\UpdateNotebookEntryRequest;
use App\Models\NotebookEntry;

class NotebookEntryService
{
    public function store(StoreNotebookEntryRequest $request)
    {
        $data = $request->validated();
        return NotebookEntry::firstOrCreate($this->checkAndModifyEntryData($data));
    }

    public function update(UpdateNotebookEntryRequest $request, string $id)
    {
        $data = $request->validated();
        $note = NotebookEntry::find($id);
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
