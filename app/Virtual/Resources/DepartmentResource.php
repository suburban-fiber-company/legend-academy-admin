<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="CourseResource",
 *     description="Course resource",
 *     @OA\Xml(
 *         name="CourseResource"
 *     )
 * )
 */
class DepartmentResource{
      /**
     * @OA\Property(
     *      title="Success",
     *      description="success",
     *      example=True
     * )
     *
     * @var boolean
     */

    public $success;

     /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Department[]
     */
    private $data;
}