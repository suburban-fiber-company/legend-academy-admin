<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Course",
 *     description="Course model",
 *     @OA\Xml(
 *         name="Course"
 *     )
 * )
 */

class Course {

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
     *      description="Name of the new course",
     *      example="Introduction to workpkace"
     * )
     *
     * @var string
     */
    public $name;
    
     /**
     * @OA\Property(
     *     title="Number Of Modules",
     *     description="Total Number Of Modules",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $number_of_modules;

      /**
     * @OA\Property(
     *     title="Number Of Enrolled",
     *     description="Total Number Of Enrolled Student",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    public $number_enrolled;

    /**
     * @OA\Property(
     *      title="User ID",
     *      description="User's id of the new course",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $user_id;

     /**
     * @OA\Property(
     *      title="Department ID",
     *      description="Department's id of the new course",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $department_id;

     /**
     * @OA\Property(
     *      title="Unit ID",
     *      description="Department unit ID of the new course",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $unit_id;

    /**
    * @OA\Property(
    *      title="Status",
    *      description="Status of the new course",
    *      format="int64",
    *      example="Published"
    * )
    *
    * @var integer
    */
   private $status;

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