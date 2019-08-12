<?php

namespace App\Transformers;

/**
 * @OA\Schema(
 *     schema="PostResponse",
 *     type="object",
 *     title="PostResponse",
 *     properties={
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="attributes", type="object", properties={
 *             @OA\Property(property="title", type="string"),
 *             @OA\Property(property="body", type="string")
 *         }),
 *         @OA\Property(property="relationships", type="array", @OA\Items({
 *
 *         })),
 *     }
 * )
 */
class PostTransformer extends Transformer
{
    public $type = 'post';

    protected $availableIncludes = ['user'];

    public function transform($user)
    {
        return [
            'id' => $user->id,
            'title' => $user->title,
            'body' => $user->body,
        ];
    }

    public function includeUser($post)
    {
        return $this->item($post->user, new UserTransformer(), 'user');
    }
}