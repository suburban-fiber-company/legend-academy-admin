<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Quiz request",
 *      description="Quiz request body data",
 *      type="object",
 * )
 */
class QuizRequest {

     /**
     * @OA\Property(
     *      title="Question Text",
     *      description="Question Text of the new Question",
     *      example="What is Laravel"
     * )
     *
     * @var string
     */
    public $question;

     /**
     * @OA\Property(
     *      title="Correct Answer",
     *      description="Correct answer of the new Question",
     *      example="Laravel is an MVC framework"
     * )
     *
     * @var string
     */
    public $correct_answer;

     /**
     * @OA\Property(
     *     title="Option",
     *     description="Question model",
     *      type="array",
     *      @OA\Items(
     *       example="Laravel is an MVC framework"
     *      )
     * )
     */
    public $options;

}