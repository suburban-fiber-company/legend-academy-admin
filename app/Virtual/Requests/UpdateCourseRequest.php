<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Course request",
 *      description="Store Course request body data",
 *      type="object",
 * )
 */
class UpdateCourseRequest {

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
}