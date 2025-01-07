<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\CollegeBaseController;
use App\Models\AlertSetting;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\Month;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Year;
use App\Traits\AcademicScope;
use App\Traits\SmsEmailScope;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use View, URL;

class AttendanceReportController extends CollegeBaseController
{
    protected $base_route = 'attendance.student.report';
    protected $view_path = 'attendance.student.report';
    protected $panel = 'Student Attendance Report';
    protected $filter_query = [];

    use AcademicScope;
    use SmsEmailScope;

    public function __construct()
    {

    }

    public function student(Request $request)
    {
        $data = [];
        $data['tag'] ='';
        if($request->all()) {
            if(auth()->user()->hasRole('staff')) {
                $id = auth()->user()->id;
                $staffId = auth()->user()->hook_id;

                if($request->has('semester_select')){
                    $semesterStaff = Semester::where('staff_id',$staffId)->where('id',$request->semester_select)->first();

                    if(isset($semesterStaff)) {

                        $students = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
                            'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
                            'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
                            'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
                            'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
                            'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
                            'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
                            'attendances.day_29', 'attendances.day_30', 'attendances.day_31', 'attendances.day_32',
                            'students.id as students_id', 'students.reg_no',
                            'students.first_name', 'students.middle_name', 'students.last_name', 'f.faculty','s.semester')
                            ->where('attendances.created_by', $id)
                            ->where('attendances.attendees_type', 1)
                            ->where('students.semester', $semesterStaff->id)
                            ->where(function ($query) use ($request) {

                                $this->commonStudentFilterCondition($query, $request);

                                if ($request->has('year') && $request->get('year') != 0) {
                                    $query->where('attendances.years_id', '=', $request->year);
                                    $this->filter_query['attendances.years_id'] = $request->year;
                                }

                                if ($request->has('month') && $request->get('month') != 0) {
                                    $query->where('attendances.months_id', '=', $request->month);
                                    $this->filter_query['attendances.months_id'] = $request->month;
                                }
                            })
                            ->join('students', 'students.id', '=', 'attendances.link_id')
                            ->join('faculties as f','f.id','=','students.faculty')
                            ->join('semesters as s','s.id','=','students.semester')
                            ->orderBy('attendances.years_id', 'asc')
                            ->orderBy('attendances.months_id', 'asc')
                            ->orderBy('attendances.link_id', 'asc')
                            ->get();
                    }else{
                        $request->session()->flash($this->message_warning, 'You are not a valid Staff for target Semester/Section.');
                    }
                }else{
                    $request->session()->flash($this->message_warning, 'Please Filter Attendance with Semester/Section.');
                }

            }else{
                if($request->attendance_status || $request->attendance_date){
                    $day = 'attendances.day_'.Carbon::parse($request->attendance_date)->format('j');
                    $students = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
                    'attendances.years_id', 'attendances.months_id', $day.' as attendance_status',
                    'students.id as students_id', 'students.reg_no',
                    'students.first_name', 'students.middle_name', 'students.last_name', 'f.faculty','s.semester')
                    ->where('attendances.attendees_type', 1)
                    ->where(function ($query) use ($request,$day) {

                        $this->commonStudentFilterCondition($query, $request);

                        if ($request->has('year') && $request->get('year') != 0) {
                            $query->where('attendances.years_id', '=', $request->year);
                            $this->filter_query['attendances.years_id'] = $request->year;
                        }

                        if ($request->has('month') && $request->get('month') != 0) {
                            $query->where('attendances.months_id', '=', $request->month);
                            $this->filter_query['attendances.months_id'] = $request->month;
                        }
                        if ($request->get('attendance_status') > 0) {
                            $query->where($day, '=', $request->attendance_status);
                            $this->filter_query[$day] = $request->attendance_status;
                        }
                    })
                    ->join('students', 'students.id', '=', 'attendances.link_id')
                    ->join('faculties as f','f.id','=','students.faculty')
                    ->join('semesters as s','s.id','=','students.semester')
                    ->orderBy('attendances.years_id','asc')
                    ->orderBy('attendances.months_id','asc')
                    ->orderBy('attendances.link_id','asc')
                    ->get();

                    $data['tag'] = 'date-status';
                    $data['date'] = $request->attendance_date;
                }else{
                    $students = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
                        'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
                        'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
                        'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
                        'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
                        'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
                        'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
                        'attendances.day_29', 'attendances.day_30', 'attendances.day_31','attendances.day_32',
                        'students.id as students_id', 'students.reg_no',
                        'students.first_name', 'students.middle_name', 'students.last_name', 'f.faculty','s.semester')
                        ->where('attendances.attendees_type', 1)
                        ->where(function ($query) use ($request) {

                            $this->commonStudentFilterCondition($query, $request);

                            if ($request->has('year') && $request->get('year') != 0) {
                                $query->where('attendances.years_id', '=', $request->year);
                                $this->filter_query['attendances.years_id'] = $request->year;
                            }

                            if ($request->has('month') && $request->get('month') != 0) {
                                $query->where('attendances.months_id', '=', $request->month);
                                $this->filter_query['attendances.months_id'] = $request->month;
                            }
                        })
                        ->join('students', 'students.id', '=', 'attendances.link_id')
                        ->join('faculties as f','f.id','=','students.faculty')
                        ->join('semesters as s','s.id','=','students.semester')
                        ->orderBy('attendances.years_id','asc')
                        ->orderBy('attendances.months_id','asc')
                        ->orderBy('attendances.link_id','asc')
                        ->get();

                    $data['tag'] = 'month-filter';
                }

            }
        }


        $attendanceStatus = AttendanceStatus::get();
        if(isset($students)){
            $filteredStudent = $students->filter(function ($student, $key) use($attendanceStatus) {
                for ($day = 1; $day <= 32; $day++) {
                    $dayCode = "day_".$day;
                    foreach ($attendanceStatus as $attenStatus){
                        if($student->$dayCode == $attenStatus->id){
                            $attenTitle = $attenStatus->title;
                            $student->$attenTitle = $student->$attenTitle + 1;
                        }
                    }
                }

                return $student;
            });



            $data['student'] = $filteredStudent;
        }

        $data['attendanceStatus'] = $attendanceStatus;
        $attendanceStatusFilter = AttendanceStatus::Active()->orderBy('title')->pluck('title','id')->toArray();/*$attendanceStatus;*/
        $data['attendanceStatusFilter'] = array_prepend($attendanceStatusFilter,'Select Status','0');
        $data['years'] = $this->activeYears();
        $data['months'] = $this->activeMonths();
        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function staff(Request $request)
    {
        return Back();
    }

}