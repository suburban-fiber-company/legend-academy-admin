<?php

namespace App\Services;

use App\Models\Department;
use App\Http\Resources\DepartmentResourse;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use DB;


class DepartmentService
{
    use BaseResponse;

    public function all()
    {
        $data = Department::orderBy('name','ASC')->simplePaginate(10);
        return DepartmentResourse::collection($data);
        
    }


    public function store($department)
    {   
        try{
            $data = Department::create($department);

            return new DepartmentResourse($data);

        } catch (\Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function update($data, $id)
    {   
        try{
            $department = Department::find($id);
            if (is_null($department)) {
                return false;
            }
            $department->update($data);

            return new DepartmentResourse($department);

        } catch (\Exception $e) {
            
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function find($id)
    {
        $data = Department::find($id);
        if (is_null($data)) {
            return false;
        }
        
        return new DepartmentResourse($data);
    }

    public function destroy($id)
    {
        $data = Department::find($id);
        if (is_null($data)) {
            return false;
        }
        $data = $data->delete();
        return $data;
        
    }
}