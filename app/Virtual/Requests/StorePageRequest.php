<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Course Module Page request",
 *      description="Store Course Module page request body data",
 *      type="object",
 * )
 */
class StorePageRequest {

    
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
}