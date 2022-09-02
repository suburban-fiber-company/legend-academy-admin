<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="QuestionOptionResource",
 *     description="Question option resource",
 *     @OA\Xml(
 *         name="QuestionOptionResource"
 *     )
 * )
 */
class QuestionOptionResource{

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
     * @var \App\Virtual\Models\QuestionOption
     */
    private $data;
}