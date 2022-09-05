<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="UserCourseResource",
 *     description="UserCourse resource",
 *     @OA\Xml(
 *         name="UserCourseResource"
 *     )
 * )
 */
class UserCourseResource{

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
     * @var \App\Virtual\Models\User[]
     */
    private $data;
}