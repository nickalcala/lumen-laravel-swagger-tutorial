<?php

namespace App\ViewModels;

/**
 * Class PostViewModel
 * @property string $title
 * @property string $body
 * @package App\ViewModels
 * @OA\Schema(
 *     schema="PostRequest",
 *     type="object",
 *     title="PostRequest",
 *     required={"title", "body"},
 *     properties={
 *         @OA\Property(property="title", type="string"),
 *         @OA\Property(property="body", type="string")
 *     }
 * )
 */
class PostViewModel extends ViewModel
{
    protected $mappings = [
        'title' => 'title',
        'body' => 'body',
    ];
}