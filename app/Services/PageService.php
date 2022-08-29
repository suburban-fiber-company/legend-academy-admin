<?php

namespace App\Services;

use App\Models\Page;
use App\Http\Resources\PageResource;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;


class PageService
{
    use BaseResponse;

    public function all()
    {
        $courses = Page::orderBy('id','DESC')->simplePaginate(10);
        return PageResource::collection($courses);
        
    }

    public function store($page)
    {   
        try{
           
            $data = Page::create($page);

            return new PageResource($data);

        } catch (\Exception $e) {
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function update($data, $id)
    {   
        try{
            $page = Page::find($id);
            if (is_null($page)) {
                return false;
            }
            $page->update($data);

            return new PageResource($page);

        } catch (\Exception $e) {
            
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function find($id)
    {
        $page = Page::find($id);
        if (is_null($page)) {
            return false;
        }
        
        return new PageResource($page);
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        if (is_null($page)) {
            return false;
        }
        $page = $page->delete();
        return $page;
        
    }
}