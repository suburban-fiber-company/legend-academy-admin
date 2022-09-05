<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Update department unit request",
 *      description="updatedepartment unit request body data",
 *      type="object",
 * )
 */
class UpdateUnitRequest {

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