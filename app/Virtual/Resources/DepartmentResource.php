<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="DepartmentResource",
 *     description="Department resource",
 *     @OA\Xml(
 *         name="DepartmentResource"
 *     )
 * )
 */
class DepartmentResource{

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