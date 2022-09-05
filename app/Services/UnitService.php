<?php

namespace App\Services;

use App\Models\Unit;
use App\Http\Resources\UnitResource;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;


class UnitService
{
    use BaseResponse;

    public function all()
    {
        $units = Unit::orderBy('id','DESC')->get();
        return UnitResource::collection($units);
        
    }

    public function store($unit)
    {   
        try{
           
            $data = Unit::create($unit);

            return new UnitResource($data);

        } catch (\Exception $e) {
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function update($data, $id)
    {   
        try{
            $unit = Unit::find($id);
            if (is_null($unit)) {
                return false;
            }
            $unit->update($data);

            return new UnitResource($unit);

        } catch (\Exception $e) {
            
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function find($id)
    {
        $unit = Unit::find($id);
        if (is_null($unit)) {
            return false;
        }
        
        return new UnitResource($unit);
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);
        if (is_null($unit)) {
            return false;
        }
        $unit = $unit->delete();
        return $unit;
        
    }
}