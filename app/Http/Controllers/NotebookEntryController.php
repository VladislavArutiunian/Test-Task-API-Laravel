<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotebookEntryResource;
use App\Models\NotebookEntry;
use Illuminate\Http\Request;

class NotebookEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NotebookEntryResource::collection(NotebookEntry::paginate(1));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
