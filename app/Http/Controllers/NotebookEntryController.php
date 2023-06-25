<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotebookEntryRequest;
use App\Http\Requests\UpdateNotebookEntryRequest;
use App\Http\Resources\NotebookEntryResource;
use App\Models\NotebookEntry;
use App\Service\NotebookEntryService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotebookEntryController extends Controller
{
    /**
     * @param NotebookEntryService $service
     */
    public function __construct(private readonly NotebookEntryService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NotebookEntryResource::collection(NotebookEntry::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotebookEntryRequest $request): NotebookEntryResource
    {
        $note = $this->service->store($request);
        return new NotebookEntryResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): NotebookEntryResource
    {
        return new NotebookEntryResource(NotebookEntry::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotebookEntryRequest $request, string $id)
    {
        $updatedEntry = $this->service->update($request, $id);
        return new NotebookEntryResource($updatedEntry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        NotebookEntry::find($id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
