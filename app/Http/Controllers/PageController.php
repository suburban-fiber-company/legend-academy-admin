<?php

namespace App\Http\Controllers;

use App\Traits\BaseResponse;
use App\Http\Requests\StorePageRequest;
use Illuminate\Http\Request;
use App\Services\PageService;

class PageController extends Controller
{
    use BaseResponse;

    public $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService; 
    }

      /**
     * @OA\Get(
     *      path="/api/v1/pages",
     *      operationId="getPagesList",
     *      tags={"Pages"},
     *      summary="Get list of module pages",
     *      description="Returns list of module pages",
     *      security={ {"bearer": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PageResource"
     *          ),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */

    public function index()
    {
        $pages = $this->pageService->all();
        if(!count($pages) > 0){
            return $this->sendResponse($pages, 'Record is Empty.'); 
        }
        return $this->sendResponse($pages, 'Record retrieved successfully.');
    }

     /**
     * @OA\Post(
     *      path="/api/v1/pages",
     *      operationId="storePage",
     *      tags={"Pages"},
     *      summary="Store new course module page",
     *      description="Returns course module page data",
     *      security={ {"bearer": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePageRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Page")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function save(StorePageRequest $request)
    {
        
        $page = $this->pageService->store($request->all());
        
        return $this->sendResponse($page, 'Page Created Successfully.', 201);
        
    }

    /**
     * @OA\Get(
     *      path="/api/v1/pages/{id}",
     *      operationId="getPageById",
     *      tags={"Pages"},
     *      summary="Get Module Page information",
     *      description="Returns module page data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Page id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Page")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function edit($id)
    {
        $page = $this->pageService->find($id);
        if(!$page){
            return $this->sendError('Page not Found.', [], 404); 
        }
        return $this->sendResponse($page,'Page retrieved Successfully.');
    }

     /**
     * @OA\Put(
     *      path="/api/v1/pages/{id}",
     *      operationId="updatePage",
     *      tags={"Pages"},
     *      summary="Update existing module page",
     *      description="Returns updated module page data",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Page id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePageRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Page")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function update(Request $request, $id)
    {   
        $page = $this->pageService->update($request->all(), $id);
        if(!$page){
            return $this->sendError('Page not Found.',[], 404); 
        }
        return $this->sendResponse($page,'Page Updated Successfully.');
    }

      /**
     * @OA\Delete(
     *      path="/api/v1/pages/{id}",
     *      operationId="deletePage",
     *      tags={"Departments"},
     *      summary="Delete existing module page",
     *      description="Deletes a record and returns no success message",
     *      security={ {"bearer": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Page id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function delete($id)
    {
        $page = $this->pageService->destroy($id);
        if(!$page){
            return $this->sendError('Page not Found.',[],404); 
        }
        return $this->sendResponse($page,'Page Deleted successfully.');
    }
}
