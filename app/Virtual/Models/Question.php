<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Question",
 *     description="Question model",
 *     @OA\Xml(
 *         name="Question"
 *     )
 * )
 */

class Question {

     /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Question Text",
     *      description="Question Text of the new Question",
     *      example="What is Laravel"
     * )
     *
     * @var string
     */
    public $question_text;
    
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
     *      @OA\Items(ref="#/components/schemas/QuestionOption")
     * )
     */
    private $question_options;

      /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

}