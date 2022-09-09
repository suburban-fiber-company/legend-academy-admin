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
    public $question;

     /**
     * @OA\Property(
     *      title="Correct Answer",
     *      description="Correct answer of the new Question",
     *      example="What is Laravel"
     * )
     *
     * @var string
     */
    public $correct_answer;
    
     /**
     * @OA\Property(
     *      title="Quiz ID",
     *      description="Quiz id of the new question",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $quiz_id;

    

  

    
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