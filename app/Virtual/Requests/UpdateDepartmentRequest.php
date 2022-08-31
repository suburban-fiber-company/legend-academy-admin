<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store Department request",
 *      description="Store Department request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateDepartmentRequest {

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new department",
     *      example="Software"
     * )
     *
     * @var string
     */
    public $name;
}