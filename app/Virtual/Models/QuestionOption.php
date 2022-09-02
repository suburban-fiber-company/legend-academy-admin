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

class QuestionOption {

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
     *      example="Laravel is an MVC"
     * )
     *
     * @var string
     */
    public $option;

     /**
     * @OA\Property(
     *      title="Correct answer",
     *      description="To determine if this option is correct",
     *      format="int64",
     *      example=0
     * )
     *
     * @var integer
     */
    public $correct;

     /**
     * @OA\Property(
     *      title="Question ID",
     *      description="Question id of the new question option",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    private $question_id;
    
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