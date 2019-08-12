<?php

namespace App\Transformers;

/**
 * @OA\Schema(
 *     schema="UserResponse",
 *     type="object",
 *     title="UserResponse",
 *     properties={
 *         @OA\Property(property="id", type="integer"),
 *         @OA\Property(property="attributes", type="object", properties={
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string")
 *         }),
 *     }
 * )
 */
class UserTransformer extends Transformer
{
    public $type = 'user';

    /**
     * @param \App\Models\User $user
     * @return array
     */
    public function transform($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
}