<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Quiz request",
 *      description="Store Quiz request body data",
 *      type="object",
 * )
 */
class StoreQuizRequest {

     /**
     * @OA\Property(
     *     title="Course ID",
     *     description="Course ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $course_id;

      /**
     * @OA\Property(
     *     title="Module ID",
     *     description="Module ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $module_id;

    /**
     * @OA\Property(
     *      title="Date Created",
     *      description="The date the Quiz was created",
     *      example="2020-01-27"
     * )
     *
     * @var string
     */
    public $date_created;

    /**
     * @OA\Property(
     *     title="Question",
     *     description="Question model",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/QuizRequest")
     * )
     */
    public $questions;
    
}