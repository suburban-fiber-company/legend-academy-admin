<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Course Module request",
 *      description="Store Course Module request body data",
 *      type="object",
 * )
 */
class UpdateModuleRequest {

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
     *      title="Course ID",
     *      description="Course id of the new course module",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $course_id;
}