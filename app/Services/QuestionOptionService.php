<?php
namespace App\Services;

use App\Models\QuestionOption as Options;
use App\Http\Resources\QuestionOptionResource;
use App\Traits\BaseResponse;

class QuestionOptionService
{
    use BaseResponse;

    public function index()
    {
        //

        $options = Options::all();

        return QuestionOptionResource::collection($options);
    }
     
    public function edit($id)
    {
        //
        $option = Options::find($id);

        if (is_null($option)) {
            return false;
        }

        return new QuestionOptionResource($option);
    }

    public function update($data, $id)
    {
        //

        $option = Options::find($id);

        if(!$option){

            return false;
        }

        $option = $option->update($data);

        $option = Options::find($id);

        return new QuestionOptionResource($option);
    }


    public function destroy($id)
    {
        //

        $option = Options::find($id);

        if(!$option){

            return false;
        }

        $option->delete();

        return new QuestionOptionResource($option);
    }
}
