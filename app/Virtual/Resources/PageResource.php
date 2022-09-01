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
class PageResource{

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
     * @var \App\Virtual\Models\Page[]
     */
    private $data;
}