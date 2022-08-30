<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserModule;
use App\Models\UserCourse;
use App\Models\Course;
use App\Models\Module;
use App\Models\Page;
use App\Models\UserPage;
use App\Http\Resources\UserResource;
use App\Traits\BaseResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use DB;
use Illuminate\Support\Facades\Hash;


class UserService
{
    use BaseResponse;

    public function all()
    {
        $users = User::orderBy('name','ASC')->simplePaginate(10);
        return UserResource::collection($users);
        
    }

    public function store($data)
    {   
        try{
            DB::beginTransaction();

            $params = $data;
            $params['password'] = Hash::make($params['password']);
            $user = User::create($params);
            if(!empty($data['courses_id']) && count($data['courses_id'])>0) {
                foreach($data['courses_id'] as $course_id){
                    $userCourse = $user->courses()->create(['course_id'=>$course_id]);
                    $modules = Module::where('course_id', $course_id)->get();
                    foreach($modules as $module) {
                        $params = [
                            'user_course_id' =>  $userCourse->id,
                            'course_id' => $course_id,
                            'module_id' => $module['id'],
                            'user_id' =>  $user->id,
                        ];

                       $userModule =  UserModule::create($params);
                       $pages = Page::where('module_id', $module['id'])->get();
                       foreach($pages as $page) {
                            $params = [
                                'user_module_id' =>  $userModule->id,
                                'page_id' => $page['id'],
                                'course_id' => $course_id,
                                'module_id' => $module['id'],
                                'user_id' =>  $user->id
                            ];

                            UserPage::create($params);
                        }
                    }   
                }   
            } 
            DB::commit();

            return new UserResource($user);

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
            $user = User::find($id);
            if (is_null($user)) {
                return false;
            }
            $user->update($data);

            return new UserResource($user);

        } catch (\Exception $e) {
            
            throw new HttpResponseException(
                $this->sendError('An Error Occured', ['error'=>$e->getMessage()],500)
            );
        }
    }

    public function find($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return false;
        }
        
        return new UserResource($user);
    }

    public function findUserCourse($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return false;
        }
     
        $userCourse = UserCourse::where('user_id', $user->id)->get();
        $courses = Course::whereIn('id', $userCourse->pluck('course_id'))->get();
        $courses = $courses->toArray();

        foreach($courses as $index => $course) {
            $userModules = UserModule::where('user_id',$user->id)
                            ->where('course_id',$course['id'])->get();
            $modules = Module::whereIn('id', $userModules->pluck('module_id'))->get();
            $modules = $modules->toArray();

            foreach($modules as $key => $module) {
                $userPages = UserPage::where('user_id', $user->id)
                            ->where('module_id',$module['id'])->get();
                $pages = Page::whereIn('id', $userPages->pluck('page_id'))->get();
                $pages = $pages->toArray();
                $modules[$key]['pages'] = $pages;
            }

            $courses[$index]['modules'] = $modules;
            
        }

        $user = $user->toArray();
        $user['courses'] = $courses;
        
        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return false;
        }
        $data = $user->delete();
        return $data;
        
    }
}