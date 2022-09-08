<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="QuizResource",
 *     description="Quiz resource",
 *     @OA\Xml(
 *         name="QuizResource"
 *     )
 * )
 */
class QuizResource{

     /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Quiz[]
     */
    private $data;
}