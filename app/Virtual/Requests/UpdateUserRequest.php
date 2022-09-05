<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="Store User request",
 *      description="Store User request body data",
 *      type="object",
 *      required={"name"}
 * )
 */
class UpdateUserRequest {

        /**
     * @OA\Property(
     *      title="Name",
     *      description="Full Name of the new user",
     *      example="Jame Prince"
     * )
     *
     * @var string
     */
    public $name;

     /**
     * @OA\Property(
     *      title="Email",
     *      description="Email address of the new user",
     *      example="james@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password of the new user",
     *      example="6464hh88"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="Phone Number",
     *      description="Phone of the new User",
     *      example="0816155633"
     * )
     *
     * @var string
     */
    public $phone_number;

    /**
     * @OA\Property(
     *      title="Address",
     *      description="Address of the new user",
     *      example="25 uloho street"
     * )
     *
     * @var string
     */
    public $address;

    /**
     * @OA\Property(
     *      title="User Type",
     *      description="User Type of the new user",
     *      example="User"
     * )
     *
     * @var string
     */
    public $user_type;

    /**
     * @OA\Property(
     *      title="Profile Image",
     *      description="Profile Image of the new user",
     * )
     *
     * @var string
     */
    public $profile_image;

     /**
     * @OA\Property(
     *      title="Department ID",
     *      description="Department's id of the new user",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $department_id;
}