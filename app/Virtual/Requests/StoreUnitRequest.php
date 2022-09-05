<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store department unit request",
 *      description="Store department unit request body data",
 *      type="object",
 * )
 */
class StoreUnitRequest {

     /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new department unit",
     *      example="finance"
     * )
     *
     * @var string
     */
    public $name;

      /**
     * @OA\Property(
     *      title="Department ID",
     *      description="Department id of the new department unit",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $department_id;   
}