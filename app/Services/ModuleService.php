<?php

namespace App\Services;

use App\Models\Module;
use App\Http\Resources\ModuleResource;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class ModuleService
{
    use BaseResponse;

    public function all()
    {
        $modules = Module::orderBy('id','DESC')->simplePaginate(10);
        return ModuleResource::collection($modules);
        
    }

    public function store($module)
    {   
        try{
           
            $data = Module::create($module);

            return new ModuleResource($data);

        } catch (\Exception $e) {
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function update($data, $id)
    {   
        try{
            $module = Module::find($id);
            if (is_null($module)) {
                return false;
            }
            $module->update($data);

            return new ModuleResource($module);

        } catch (\Exception $e) {
            
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function find($id)
    {
        $module = Module::find($id);
        if (is_null($module)) {
            return false;
        }
        
        return new ModuleResource($module);
    }

    public function destroy($id)
    {
        $module = Module::find($id);
        if (is_null($module)) {
            return false;
        }
        $data = $module->delete();
        return $data;
        
    }
}