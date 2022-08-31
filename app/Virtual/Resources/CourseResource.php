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
class CourseResource{

      /**
     * @OA\Property(
     *      title="Success",
     *      description="success",
     *      example=True
     * )
     *
     * @var boolean
     */

    private $success;

     /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Course[]
     */
    private $data;
}