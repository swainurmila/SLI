<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCourse;
use App\Models\Course\CrCategoryMaster;
use App\Models\Course\CrSyllabus;
use App\Models\Language;
use App\Models\Course\CrPlaceMaster;
use App\Models\Course\CrCourseRating;
use App\Models\Course\CrTransactionTable;
use Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    public function courseList(){
        try {
            $course = CrCourse::orderBy('id','desc')->paginate(10);
            return view('course.admin.course.index',compact('course'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function createCourse(){
        try {
            $cr_category = CrCategoryMaster::get();
            $languages = Language::get();
            $place = CrPlaceMaster::get();
            return view('course.admin.course.create_course',compact('cr_category','languages', 'place'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function createCourseStore(Request $request){
        try {
            $data = $this->validate($request, [
                'course_name' => 'required|unique:cr_course',
                'course_category_id' => 'required',
                'course_mode' => 'required',
                'course_start_date' => 'required',
                'course_end_date' => 'required',
                'language_id' => 'required',
                'course_image' => 'required|file|max:1024',
                'payment_type' => 'required',
                'certificate_type' => 'required',
                'course_description'=> 'required',
            ]);
            //return $request;
            if ($file = $request->file('course_image')) {
                $data = $request->file('course_image');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'course_image' . '.' . $extension;
                $path = public_path('/upload/course/course_image/');
                $upload_success = $data->move($path, $filename);
                $upload_file = '/upload/course/course_image/' . $filename;
            }
            $data = new CrCourse();
            $data->course_name = $request->course_name;
            $data->course_category_id = $request->course_category_id;
            $data->course_mode = $request->course_mode;
            // $data->student_strength = $request->student_strength;
            $data->place = $request->place;
            $data->payment_type = $request->payment_type;
            $data->certificate_type = $request->certificate_type;
            $data->course_start_date = $request->course_start_date;
            $data->course_end_date = $request->course_end_date;
            $data->course_price = $request->course_price;
            $data->course_image = $upload_file;
            $data->course_description = $request->course_description;
            $data->language_id = $request->language_id;
            $data->save();

            Session::flash('success', trans('Course added successfully'));
            return redirect()->route('course.admin.courseList');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Edit course
    public function editCourse(Request $request, $id){
        try {
            $cr_categories = CrCategoryMaster::get();
            $languages = Language::get();
            $course_data = CrCourse::where('id',$id)->first();
            $syllabus = CrSyllabus::where('course_id', $id)->get();
            $place = CrPlaceMaster::get();
            return view('course.admin.course.edit_course',compact('cr_categories','languages','course_data', 'syllabus', 'place'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function editCourseStore(Request $request,$id){
        try {
            $data = $this->validate($request, [
                'course_name' => 'required',
                'course_category_id' => 'required',
                'course_mode' => 'required',
                'course_start_date' => 'required',
                'course_end_date' => 'required',
                'language_id' => 'required',
                'payment_type' => 'required',
                'certificate_type' => 'required',
                'course_description'=> 'required',
            ]);

            if ($file = $request->file('course_image')) {
                $data = $request->file('course_image');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'course_image' . '.' . $extension;
                $path = public_path('/upload/course/course_image/');
                $upload_success = $data->move($path, $filename);
                $upload_file = '/upload/course/course_image/' . $filename;
            }else{
                $upload_file = $request->old_course_image;
            }
            $data = CrCourse::where('id',$id)->first();
            $data->course_name = $request->course_name;
            $data->course_category_id = $request->course_category_id;
            $data->course_mode = $request->course_mode;
            $data->student_strength = $request->student_strength;
            $data->place = $request->place;
            $data->payment_type = $request->payment_type;
            $data->certificate_type = $request->certificate_type;
            $data->course_start_date = $request->course_start_date;
            $data->course_end_date = $request->course_end_date;
            $data->course_price = $request->course_price;
            $data->course_image = $upload_file;
            $data->course_description = $request->course_description;
            $data->language_id = $request->language_id;
            $data->update();

            Session::flash('success', trans('Course updated successfully'));
            return redirect()->route('course.admin.courseList');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function courseView($id){
        try {
             $course = CrCourse::with('Place', 'Syllabus', 'Category', 'Language', 'Exam', 'Question', 'Module', 'Ratings')->where('id',$id)->first();
            //  dd($course);
             $startDate = \Carbon\Carbon::parse($course->course_start_date);
             $endDate = \Carbon\Carbon::parse($course->course_end_date);
             $durationInDays = $endDate->diffInDays($startDate);

            $totalRatings = CrCourseRating::with('userDetails')->where('course_id',$id)->get();
            $avg_ratings = CrCourseRating::with('userDetails')->where('course_id',$id)->avg('rating');
            $roundedAverageRating = round($avg_ratings, 2);

           return view("course.admin.course.view_course", compact('course', 'durationInDays','totalRatings','avg_ratings','roundedAverageRating'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Course Transaction List
    public function courseTransaction(){
        try{
             $transaction = CrTransactionTable::with('User', 'Course')->get();
            return view("course.admin.course.transaction_list", compact('transaction'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }


}
