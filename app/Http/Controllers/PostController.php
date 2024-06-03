<?php

namespace App\Http\Controllers;

use App\Actions\Post\DeletePostAction;
use App\Actions\Post\GetAllPostsAction;
use App\Actions\Post\GetPostAction;
use App\Actions\Post\StorePostAction;
use App\Actions\Post\UpdatePostAction;
use App\DTOs\PostStoreDto;
use App\DTOs\PostUpdateDto;
use App\Http\Requests\ShowPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Attributes as OA;

class PostController extends Controller
{
    /**
     * Index all posts
     * @param GetAllPostsAction $action
     * @return AnonymousResourceCollection
     */
    #[OA\Get(path: '/', tags: ['posts'])]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/PostResource')
    )]
    public function index(GetAllPostsAction $action): AnonymousResourceCollection
    {
        return PostResource::collection($action->execute());
    }

    /**
     * Store Post
     * @param StorePostRequest $request
     * @param StorePostAction $action
     * @return PostResource
     */
    #[OA\Post(path: '/', tags: ['posts'])]
    #[OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/StorePostRequest'))]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/PostResource')
    )]
    public function store(StorePostRequest $request, StorePostAction $action): PostResource
    {
        $dto = PostStoreDto::fromRequest($request);

        return PostResource::make($action->execute($dto));
    }

    /**
     * Show Post
     * @param ShowPostRequest $request
     * @param GetPostAction $action
     * @return PostResource
     */
    #[OA\Get(path: '/{post_id}', tags: ['posts'])]
    #[OA\PathParameter(name: 'post_id', required: true)]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/PostResource')
    )]
    public function show(ShowPostRequest $request, GetPostAction $action): PostResource
    {
        return PostResource::make($action->execute($request->id));
    }

    /**
     * Update Post
     * @param UpdatePostRequest $request
     * @param UpdatePostAction $action
     * @param GetPostAction $getPostAction
     * @return PostResource
     */
    #[OA\Patch(path: '/{post_id}', tags: ['posts'])]
    #[OA\PathParameter(name: 'post_id', required: true)]
    #[OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/UpdatePostRequest'))]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(ref: '#/components/schemas/PostResource')
    )]
    public function update(UpdatePostRequest $request, UpdatePostAction $action, GetPostAction $getPostAction)
    {
        $dto = PostUpdateDto::fromRequest($request);

        $post = $getPostAction->execute($dto->getId());
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }

        return PostResource::make($action->execute($dto));
    }

    /**
     * Delete Post
     * @param ShowPostRequest $request
     * @param GetPostAction $getPostAction
     * @param DeletePostAction $deletePostAction
     * @return JsonResponse
     */
    #[OA\Delete(path: '/{post_id}', tags: ['posts'])]
    #[OA\PathParameter(name: 'post_id', required: true)]
    #[OA\Response(response: 204, description: 'No content')]
    public function destroy(ShowPostRequest $request, GetPostAction $getPostAction, DeletePostAction $deletePostAction): JsonResponse
    {
        $post = $getPostAction->execute($request->id);
        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }

        return response()->json('', 204);
    }
}
