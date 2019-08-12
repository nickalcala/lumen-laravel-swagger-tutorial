<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Transformers\PostTransformer;
use App\ViewModels\PostViewModel;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/posts",
     *     summary="List all posts",
     *     operationId="index",
     *     tags={"Post"},
     *     @OA\Parameter(
     *         name="include",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                 type="string",
     *                 enum = {"user"},
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="An paged array of posts",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/PostResponse")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\Schema(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function index()
    {
        return $this->paginate(\App\Models\Post::paginate(5), new PostTransformer());
    }

    /**
     * @OA\Post(
     *     path="/posts",
     *     summary="New blog post",
     *     operationId="store",
     *     tags={"Post"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Post object",
     *         @OA\JsonContent(ref="#/components/schemas/PostRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A post",
     *         @OA\JsonContent(ref="#/components/schemas/PostResponse"),
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\Schema(ref="#/components/schemas/Error")
     *     )
     * )
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $viewModel = new PostViewModel();
        $viewModel->mapArray($request->json()->all());

        // Transfer this on a service class or do some validation.
        $post = new Post();
        $post->user_id = 1;
        $post->title = $viewModel->title;
        $post->body = $viewModel->body;
        $post->save();

        return $this->item($post, new PostTransformer());
    }
}