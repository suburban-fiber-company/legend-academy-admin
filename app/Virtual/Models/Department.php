<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Department",
 *     description="Department model",
 *     @OA\Xml(
 *         name="Depertment"
 *     )
 * )
 */

class Department {

     /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the department course",
     *      example="Software"
     * )
     *
     * @var string
     */
    public $name;
}