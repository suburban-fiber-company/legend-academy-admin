<?php

namespace App\Http\Controllers;

use App\Traits\BaseResponse;
use App\Http\Requests\StoreCourseRequest;
use Illuminate\Http\Request;
use App\Services\CourseService;

class CourseController extends Controller
{
    //
    use BaseResponse;

    public $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService; 
    }

    public function index()
    {
        $courses = $this->courseService->all();
        if(!count($courses) > 0){
            return $this->sendResponse($courses, 'Record is Empty.'); 
        }
        return $this->sendResponse($courses, 'Record retrieved successfully.');
    }

    public function courseModule()
    {
        $courses = $this->courseService->courseModule();
        if(!count($courses) > 0){
            return $this->sendResponse($courses, 'Record is Empty.'); 
        }
        return $this->sendResponse($courses, 'Record retrieved successfully.');
    }

    public function save(StoreCourseRequest $request)
    {
        
        $course = $this->courseService->store($request->all());
        
        return $this->sendResponse($course, 'Course Created Successfully.', 201);
        
    }

    public function edit($id)
    {
        $course = $this->courseService->find($id);
        if(!$course){
            return $this->sendError('Course not Found.', [], 404); 
        }
        return $this->sendResponse($course,'Course retrieved Successfully.');
    }

    public function findCourseModule($id)
    {
        $course = $this->courseService->findCourseModule($id);
        if(!$course){
            return $this->sendError('Course not Found.', [], 404); 
        }
        return $this->sendResponse($course,'Course retrieved Successfully.');
    }

    public function update(Request $request, $id)
    {   
        $course = $this->courseService->update($request->all(), $id);
        if(!$course){
            return $this->sendError('Course not Found.',[], 404); 
        }
        return $this->sendResponse($course,'Course Updated Successfully.');
    }

    public function delete($id)
    {
        $course = $this->courseService->destroy($id);
        if(!$course){
            return $this->sendError('Course not Found.',[],404); 
        }
        return $this->sendResponse($course,'Course Delete successfully.');
    }
}
