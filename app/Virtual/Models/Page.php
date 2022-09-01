<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Page",
 *     description="Page model",
 *     @OA\Xml(
 *         name="Page Model"
 *     )
 * )
 */

class Page {

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
     *      title="Title",
     *      description="Title of the new course module page",
     *      example="Introduction to workpkace"
     * )
     *
     * @var string
     */
    public $title;

      /**
     * @OA\Property(
     *      title="Content",
     *      description="Content of the new course module page",
     *      example="Introduction to workpkace"
     * )
     *
     * @var string
     */
    public $content;

      /**
     * @OA\Property(
     *      title="Course ID",
     *      description="Course id of the new course module page",
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
     *      description="Module id of the new course module page",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $module_id;
    
    
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