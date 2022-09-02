<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Question Option request",
 *      description="Store Question option request body data",
 *      type="object",
 * )
 */
class StoreQuestionOptionRequest {

    /**
     * @OA\Property(
     *      title="Question Text",
     *      description="Question Text of the new Question",
     *      example="Laravel is an MVC"
     * )
     *
     * @var string
     */
    public $option;

     /**
     * @OA\Property(
     *      title="Correct answer",
     *      description="To determine if this option is correct, 1 is correct answer",
     *      format="int64",
     *      example=0
     * )
     *
     * @var integer
     */
    public $correct;
    
}