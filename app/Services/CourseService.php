<?php

namespace App\Services;

use App\Models\Course;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseModuleResource;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use DB;


class CourseService
{
    use BaseResponse;

    public function all()
    {
        $courses = Course::with('modules.pages')->paginate(10);

        return $courses;
        //return CourseResource::collection($courses);
        
    }

    public function courseModule()
    {
        $courses = Course::orderBy('name','ASC')->simplePaginate(10);
        return CourseModuleResource::collection($courses);
        
    }

    public function store($course)
    {   
        try{
            DB::beginTransaction();

            $course = Course::create($course);

            $module = $course->modules()->create([
                'course_id' => $course->id,
                'title'   => 'First Title',
            ]);

            $module->pages()->create([
                'course_id' => $course->id,
                'title' => 'First Title',
                'content' => 'First Content',
            ]);
            
            DB::commit();

            $data = Course::find($course->id);

            return new CourseModuleResource($data);

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
            $course = Course::find($id);
            if (is_null($course)) {
                return false;
            }
            unset($data['status']);
            $course->update($data);

            return new CourseResource($course);

        } catch (\Exception $e) {
            
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function find($id)
    {
        $course = Course::find($id);
        if (is_null($course)) {
            return false;
        }
        
        return new CourseModuleResource($course);
    }

    public function findCourseModule($id)
    {
        $course = Course::find($id);
        if (is_null($course)) {
            return false;
        }
        
        return new CourseModuleResource($course);
    }

    public function publish($course, $id)
    {
        $course = Course::find($id);
        $course->update(['status'=>1]);

        return new CourseResource($course);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        if (is_null($course)) {
            return false;
        }
        $data = $course->delete();
        return $data;
        
    }
}