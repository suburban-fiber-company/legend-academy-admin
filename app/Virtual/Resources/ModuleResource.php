<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ModuleResource",
 *     description="Module resource",
 *     @OA\Xml(
 *         name="ModuleResource"
 *     )
 * )
 */
class ModuleResource{

     /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Module[]
     */
    private $data;
}