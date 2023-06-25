<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotepadContactRequest;
use App\Http\Requests\UpdateNotepadContactRequest;
use App\Http\Resources\NotepadContactResource;
use App\Models\NotepadContact;
use App\Service\NotepadContactService;
use Symfony\Component\HttpFoundation\Response;

class NotepadContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NotepadContact $contactBook)
    {
        dd($contactBook->all());
        $contacts = NotepadContact::paginate(10);
        return NotepadContactResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotepadContactRequest $request, NotepadContactService $service): NotepadContactResource
    {
        $note = $service->store($request);
        return new NotepadContactResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): NotepadContactResource
    {
        return new NotepadContactResource(NotepadContact::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateNotepadContactRequest $request,
        NotepadContactService       $service,
        string                      $id,
    ) {
        $updatedEntry = $service->update($request, $id);
        return new NotepadContactResource($updatedEntry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        NotepadContact::find($id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
