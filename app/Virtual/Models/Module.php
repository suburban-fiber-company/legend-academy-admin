<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Module",
 *     description="Module model",
 *     @OA\Xml(
 *         name="Module"
 *     )
 * )
 */

class Module {

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
     *      title="Name",
     *      description="Title of the new course module",
     *      example="Introduction to workpkace"
     * )
     *
     * @var string
     */
    public $title;
    
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

     /**
     * @OA\Property(
     *      title="Course ID",
     *      description="Course id of the new course module",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $course_id;

    /**
     * @OA\Property(
     *     title="Page",
     *     description="Page model",
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/Page")
     * )
     */
    private $pages;

}