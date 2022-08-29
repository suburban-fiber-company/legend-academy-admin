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

    public function index()
    {
        $pages = $this->pageService->all();
        if(!count($pages) > 0){
            return $this->sendResponse($pages, 'Record is Empty.'); 
        }
        return $this->sendResponse($pages, 'Record retrieved successfully.');
    }

    public function save(StorePageRequest $request)
    {
        
        $page = $this->pageService->store($request->all());
        
        return $this->sendResponse($page, 'Page Created Successfully.', 201);
        
    }

    public function edit($id)
    {
        $page = $this->pageService->find($id);
        if(!$page){
            return $this->sendError('Page not Found.', [], 404); 
        }
        return $this->sendResponse($page,'Page retrieved Successfully.');
    }

    public function update(Request $request, $id)
    {   
        $page = $this->pageService->update($request->all(), $id);
        if(!$page){
            return $this->sendError('Page not Found.',[], 404); 
        }
        return $this->sendResponse($page,'Page Updated Successfully.');
    }

    public function delete($id)
    {
        $page = $this->pageService->destroy($id);
        if(!$page){
            return $this->sendError('Page not Found.',[],404); 
        }
        return $this->sendResponse($page,'Page Deleted successfully.');
    }
}
