<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(version: "1.0.0", title: "test")]
#[OA\Tag(name: 'users', description: 'Users')]
#[OA\Tag(name: 'posts', description: 'Posts')]
#[OA\Tag(name: 'currencies', description: 'Currencies')]
abstract class Controller
{
    //
}
