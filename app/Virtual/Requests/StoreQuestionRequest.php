<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Question request",
 *      description="Store Question request body data",
 *      type="object",
 * )
 */
class StoreQuestionRequest {


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
     *      title="Course ID",
     *      description="Course id of the new question",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $course_id;

     /**
     * @OA\Property(
     *      title="Module ID",
     *      description="Module id of the new Question",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $module_id;

      /**
     * @OA\Property(
     *      title="Time Limit",
     *      description="Time Limit (sec) of the new Question",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $time_limit;
    
     /**
     * @OA\Property(
     *     title="QuestionOption",
     *     description="QuestionOption model",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/StoreQuestionOptionRequest")
     * )
     */
    public $question_options;
}