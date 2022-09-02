<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="QuestionResource",
 *     description="Question resource",
 *     @OA\Xml(
 *         name="QuestionResource"
 *     )
 * )
 */
class QuestionResource{

      /**
     * @OA\Property(
     *      title="Success",
     *      description="success",
     *      example=True
     * )
     *
     * @var boolean
     */

    private $success;

     /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Question[]
     */
    private $data;
}