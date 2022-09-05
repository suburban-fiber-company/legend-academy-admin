<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Unit",
 *     description="Unit model",
 *     @OA\Xml(
 *         name="Unit Model"
 *     )
 * )
 */

class Unit {

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
     *      description="Department id of the new department",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $department_id;   
    
    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

}