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
class CourseModuleResource{

     /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\CourseModule[]
     */
    private $data;
}