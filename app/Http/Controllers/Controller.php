<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[
    OA\Info(
    version: '1.0.0',
    description: 'API Test Task Notebook contacts on Laravel',
    title: 'Notebook contacts API app',
    contact: new OA\Contact(email: 'vladislav.arutiunian@gmail.com')
    ),
    OA\Server(
        url: 'http://127.0.0.1:8000/api/v1/',
        description: 'local'
    )
]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
