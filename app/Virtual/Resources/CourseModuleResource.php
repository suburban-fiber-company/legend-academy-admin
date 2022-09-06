<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="CourseModuleResource",
 *     description="Course resource",
 *     @OA\Xml(
 *         name="CourseResource"
 *     )
 * )
 */
class CourseModuleResource{

     /**
     * @OA\Property(
     *      title="current_page",
     *      description="current page",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $current_page;

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\CourseModule[]
     */
    private $data;

      /**
     * @OA\Property(
     *      title="First Page Url",
     *      description="First Page Url",
     *      type="string",
     *      example="http://legend.test/api/v1/courses?page=1"
     * )
     *
     * @var string
     */
    public $first_page_url;

    /**
     * @OA\Property(
     *      title="from",
     *      description="from",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $from;

     /**
     * @OA\Property(
     *      title="last page",
     *      description="last page",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $last_page;

      /**
     * @OA\Property(
     *      title="Last Page Url",
     *      description="Last Page Url",
     *      type="string",
     *      example="http://legend.test/api/v1/courses?page=1"
     * )
     *
     * @var string
     */
    public $last_page_url;

    
      /**
     * @OA\Property(
     *      title="Next Page Url",
     *      description="Next Page Url",
     *      type="string",
     *      example=null
     * )
     *
     * @var string
     */
    public $next_page_url;

    /**
     * @OA\Property(
     *      title="path",
     *      description="path",
     *      type="string",
     *      example= "http://legend.test/api/v1/courses"
     * )
     *
     * @var string
     */
    public $path;

    /**
     * @OA\Property(
     *      title="Per Page",
     *      description="Per Page",
     *      format="int64",
     *      example=10
     * )
     *
     * @var integer
     */
    public $per_page;

     /**
     * @OA\Property(
     *      title="prev page url",
     *      description="prev page url",
     *      type="string",
     *      example= null
     * )
     *
     * @var string
     */
    public $prev_page_url;

    /**
     * @OA\Property(
     *      title="To",
     *      description="to",
     *      format="int64",
     *      example=2
     * )
     *
     * @var integer
     */
    public $to;

     /**
     * @OA\Property(
     *      title="Total",
     *      description="Total",
     *      format="int64",
     *      example=10
     * )
     *
     * @var integer
     */
    public $total;
}