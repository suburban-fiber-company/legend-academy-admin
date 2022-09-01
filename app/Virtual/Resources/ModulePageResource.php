<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="ModulePageResource",
 *     description="Course resource",
 *     @OA\Xml(
 *         name="ModulePageResource"
 *     )
 * )
 */
class ModulePageResource{

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
     * @var \App\Virtual\Models\Module[]
     */
    private $data;
}