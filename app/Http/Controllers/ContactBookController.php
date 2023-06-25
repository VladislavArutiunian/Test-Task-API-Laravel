<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactBookRequest;
use App\Http\Requests\UpdateContactBookRequest;
use App\Http\Resources\ContactBookResource;
use App\Models\ContactBook;
use App\Service\ContactBookService;
use Symfony\Component\HttpFoundation\Response;

class ContactBookController extends Controller
{
    /**
     * @param ContactBookService $service
     */
    public function __construct(private readonly ContactBookService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContactBookResource::collection(ContactBook::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactBookRequest $request): ContactBookResource
    {
        $note = $this->service->store($request);
        return new ContactBookResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ContactBookResource
    {
        return new ContactBookResource(ContactBook::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactBookRequest $request, string $id)
    {
        $updatedEntry = $this->service->update($request, $id);
        return new ContactBookResource($updatedEntry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ContactBook::find($id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
