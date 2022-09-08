<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Quiz",
 *     description="Quiz model",
 *     @OA\Xml(
 *         name="Quiz"
 *     )
 * )
 */

class Quiz {

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
     *     title="Publish",
     *     description="Publish",
     *     format="int64",
     *     example=false
     * )
     *
     * @var boolean
     */
    private $publish;

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
     *     title="Qustions",
     *     description="Question model",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Question")
     * )
     */
    private $questions;

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