<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexNotepadContactRequest;
use App\Http\Requests\StoreNotepadContactRequest;
use App\Http\Requests\UpdateNotepadContactRequest;
use App\Http\Resources\NotepadContactResource;
use App\Models\NotepadContact;
use App\Service\NotepadContactService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Notebook',
    description: 'Notebook API'
)]
class NotepadContactController extends Controller
{
    /**
     * @param IndexNotepadContactRequest $request
     * @param NotepadContact $notepadContact
     * @return AnonymousResourceCollection
     */
    #[OA\Get (
        path:"/api/v1/notebook",
        description: "Display all contacts in the notepad",
        summary: 'Display all contacts in the notepad',
        tags: ['Notebook'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
            ),
            new OA\Response(
                response: 400,
                description: 'Bad request'
            ),
        ]
    )
]
    public function index(IndexNotepadContactRequest $request, NotepadContact $notepadContact) {
        $validated = $request->validated();
        $perPageDefault = config('api.notepad_contacts.defaults.per_page_index');
        $perPage = $validated['per_page'] ?? $perPageDefault;

        $contacts = $notepadContact->paginate($perPage);
        return NotepadContactResource::collection($contacts);
    }

    /**
     * @param StoreNotepadContactRequest $request
     * @param NotepadContactService $service
     * @return NotepadContactResource
     */
    #[OA\Post (
        path:"/api/v1/notebook/",
        description: "Display the specified contact.",
        summary: 'Store a newly created resource in storage',
        tags: ['Notebook'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
            ),
            new OA\Response(
                response: 400,
                description: 'Bad request'
            ),
        ]
    )
    ]
    public function store(
        StoreNotepadContactRequest $request,
        NotepadContactService $service
    ): NotepadContactResource {
        $note = $service->store($request);
        return new NotepadContactResource($note);
    }

    /**
     * @param string $id
     * @return NotepadContactResource
     */
    #[OA\Get (
        path:"/api/v1/notebook/{id}",
        description: "Display the specified contact.",
        summary: 'Display the specified contact',
        tags: ['Notebook'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
            ),
            new OA\Response(
                response: 400,
                description: 'Bad request'
            ),
        ]
    )]
    public function show(string $id): NotepadContactResource
    {
        return new NotepadContactResource(NotepadContact::findOrFail($id));
    }

    /**
     * @param UpdateNotepadContactRequest $request
     * @param NotepadContactService $service
     * @param string $id
     * @return NotepadContactResource
     */
    #[OA\Put (
        path:"/api/v1/notebook/{id}",
        description: "Display the specified contact.",
        summary: 'Update the specified resource in storage',
        tags: ['Notebook'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
            ),
            new OA\Response(
                response: 400,
                description: 'Bad request'
            ),
        ]
    )]
    public function update(
        UpdateNotepadContactRequest $request,
        NotepadContactService       $service,
        string                      $id,
    ): NotepadContactResource
    {
        $updatedEntry = $service->update($request, $id);
        return new NotepadContactResource($updatedEntry);
    }

    /**
     * @param string $id
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    #[OA\Delete (
        path:"/api/v1/notebook/{id}",
        description: "Display the specified contact.",
        summary: 'Display the specified contact',
        tags: ['Notebook'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successful operation',
            ),
            new OA\Response(
                response: 400,
                description: 'Bad request'
            ),
        ]
    )
    ]
    public function destroy(string $id)
    {
        NotepadContact::find($id)->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
