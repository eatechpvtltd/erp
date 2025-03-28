<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Report;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use  URL;
use ViewHelper;

class StudentReportController extends CollegeBaseController
{
    protected $base_route = 'report.student';
    protected $view_path = 'report.student';
    protected $panel = 'Student Report';
    protected $filter_query = [];

    public function __construct()
    {
    }

    // public function index(Request $request)
    // {
    //     $data = [];
    //     if ($request->all()){
    //         $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
    //             'students.faculty', 'students.semester', 'students.batch', 'academic_status', 'students.first_name',
    //             'students.middle_name', 'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group',
    //             'nationality', 'students.national_id_1', 'students.national_id_2', 'students.national_id_3', 'students.national_id_4',
    //             'students.religion', 'students.caste','mother_tongue', 'students.email', 'students.extra_info', 'students.status',

    //             'pd.grandfather_first_name', 'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name',
    //             'pd.father_middle_name', 'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation',
    //             'pd.father_office', 'pd.father_office_number', 'pd.father_residence_number', 'pd.father_mobile_1',
    //             'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name', 'pd.mother_middle_name', 'pd.mother_last_name',
    //             'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office', 'pd.mother_office_number',
    //             'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',

    //             'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
    //             'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number',
    //             'gd.guardian_residence_number', 'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email',
    //             'gd.guardian_relation', 'gd.guardian_address',

    //             'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
    //             'ai.mobile_1', 'ai.mobile_2',

    //             'ei.total_fee_per_year', 'ei.bank_name', 'ei.bank_code', 'ei.bank_account_number',
    //             'ei.admission_portal_login_id', 'ei.admission_portal_login_password',

    //             'ss.scholarships_id', 'ss.scholarship_application_id', 'ss.scholarship_user_name', 'ss.scholarship_password',

    //             'pl.placements_id', 'pl.placement_date', 'pl.placement_salary', 'pl.placement_location', 'pl.placement_designation',
    //         )
    //             ->where(function ($query) use ($request) {
    //                 $this->commonStudentFilterCondition($query, $request);
    //             })
    //             ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
    //             ->join('student_guardians as sg', 'sg.students_id','=','students.id')
    //             ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
    //             ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
    //             ->join('student_extra_infos as ei', 'ei.students_id','=','students.id')
    //             ->join('student_scholarships as ss', 'ss.students_id','=','students.id')
    //             ->join('student_placements as pl', 'pl.students_id','=','students.id')
    //             ->distinct()
    //             ->get();
                
                 
    //     }
        
    //     //   return response()->json($data['student']);

    //     $data['faculties'] = $this->activeFaculties();
    //     $data['batch'] = $this->activeBatch();
    //     $data['academic_status'] = $this->activeStudentAcademicStatus();
    //     $data['degrees'] = $this->activeDegrees();
    //     //dd($data['degrees']->toArray());

    //     $data['url'] = URL::current();
    //     $data['filter_query'] = $this->filter_query;
        
        
     

    //     return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    // }
public function index(Request $request)
    {

        // return  $request;

        $data = [];
        $query = Student::select(
            'students.id',
            'students.reg_no',
            'students.reg_date',
            'students.university_reg',
            'students.faculty',
            'students.semester',
            'students.batch',
            'students.academic_status',
            'students.first_name',
            'students.middle_name',
            'students.last_name',
            'students.date_of_birth',
            'students.gender',
            'students.blood_group',
            'nationality',
            'students.national_id_1',
            'students.national_id_2',
            'students.national_id_3',
            'students.national_id_4',
            'students.religion',
            'students.caste',
            'mother_tongue',
            'students.email',
            'students.extra_info',
            'students.status',

            'pd.grandfather_first_name',
            'pd.grandfather_middle_name',
            'pd.grandfather_last_name',
            'pd.father_first_name',
            'pd.father_middle_name',
            'pd.father_last_name',
            'pd.father_eligibility',
            'pd.father_occupation',
            'pd.father_office',
            'pd.father_office_number',
            'pd.father_residence_number',
            'pd.father_mobile_1',
            'pd.father_mobile_2',
            'pd.father_email',
            'pd.mother_first_name',
            'pd.mother_middle_name',
            'pd.mother_last_name',
            'pd.mother_eligibility',
            'pd.mother_occupation',
            'pd.mother_office',
            'pd.mother_office_number',
            'pd.mother_residence_number',
            'pd.mother_mobile_1',
            'pd.mother_mobile_2',
            'pd.mother_email',

            'gd.guardian_first_name',
            'gd.guardian_middle_name',
            'gd.guardian_last_name',
            'gd.guardian_eligibility',
            'gd.guardian_occupation',
            'gd.guardian_office',
            'gd.guardian_office_number',
            'gd.guardian_residence_number',
            'gd.guardian_mobile_1',
            'gd.guardian_mobile_2',
            'gd.guardian_email',
            'gd.guardian_relation',
            'gd.guardian_address',

            'ai.address',
            'ai.state',
            'ai.country',
            'ai.temp_address',
            'ai.temp_state',
            'ai.temp_country',
            'ai.home_phone',
            'ai.mobile_1',
            'ai.mobile_2',

            'ei.total_fee_per_year',
            'ei.bank_name',
            'ei.bank_code',
            'ei.bank_account_number',
            'ei.admission_portal_login_id',
            'ei.admission_portal_login_password',

            'ss.scholarships_id',
            'ss.scholarship_application_id',
            'ss.scholarship_user_name',
            'ss.scholarship_password',

            'pl.placements_id',
            'pl.placement_date',
            'pl.placement_salary',
            'pl.placement_location',
            'pl.placement_designation'
        )
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('student_guardians as sg', 'sg.students_id', '=', 'students.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->join('student_extra_infos as ei', 'ei.students_id', '=', 'students.id')
            ->join('student_scholarships as ss', 'ss.students_id', '=', 'students.id')
            ->join('student_placements as pl', 'pl.students_id', '=', 'students.id');


        // Apply Filters
        if ($request->all()) {

            // return $request->all();

            if ($request->filled('semester_select')) {
                $query->where('students.semester', 'like', "%{$request->semester_select}%");
            }

            if ($request->filled('faculty')) {
                $query->where('students.faculty', $request->faculty);
            }

            if ($request->filled('batch')) {
                $query->where('students.batch', $request->batch);
            }

            if ($request->filled('reg_no')) {
                $query->where(function ($q) use ($request) {
                    $q->where('students.reg_no', $request->reg_no)
                        ->orWhere('students.university_reg', $request->reg_no);
                });
            }

            if ($request->filled('reg_start_date') && $request->filled('reg_end_date')) {
                $query->whereBetween('students.reg_date', [$request->reg_start_date, $request->reg_end_date]);
            } elseif ($request->filled('reg_start_date')) {
                $query->whereDate('students.reg_date', $request->reg_start_date);
            } elseif ($request->filled('reg_end_date')) {
                $query->whereDate('students.reg_date', $request->reg_end_date);
            }

            $exactMatchFields = [
                'reg_no',
                'university_reg',
                'first_name',
                'middle_name',
                'last_name',
                'gender',
                'blood_group',
                'nationality',
                'national_id_1',
                'national_id_2',
                'national_id_3',
                'national_id_4',
                'religion',
                'caste',
                'mother_tongue',
                'email',
                'ai.mobile_1',
                'ai.mobile_2',
                'date_of_birth_start_date',
                'ai.address',
                'academic_status',
            ];

            foreach ($request->query() as $key => $value) {
                $trimmedValue = trim($value);
                if (!empty($trimmedValue) && $trimmedValue !== 'undefined') {
                    if ($key === 'date_of_birth_start_date') {
                        $query->whereDate('students.date_of_birth', $trimmedValue);
                    } elseif ($key === 'ai.address') {
                        $query->where('ai.address', 'like', "%$trimmedValue%");
                    } elseif ($key === 'semester_select') {
                        // Map "semester_select" to the actual column "semester"
                        $query->where('students.semester', 'like', "%$trimmedValue%");
                    } else {
                        $query->where("students.$key", 'like', "%$trimmedValue%");
                    }
                }
            }
            // Ignore Undefined National IDs
            // foreach (['national_id_1', 'national_id_2', 'national_id_3', 'national_id_4'] as $national_id) {
            //     if ($request->filled($national_id) && $request->$national_id !== 'undefined') {
            //         $query->where("students.$national_id", 'like', '%' . $request->$national_id . '%');
            //     }
            // }

            $data['student'] = $query->paginate(env('PAGINATION_LIMIT', $this->pagination_limit));

            // return response()->json([
            //     'status' => 'success',
            //     'data' => $data['student']
            // ]);
        }


        // Default Fetch if No Filters
        $data['student'] = $query->where('students.status', 1)
            ->limit($this->defaultDataFetch)
            ->paginate(env('PAGINATION_LIMIT', $this->pagination_limit));

        // Get related faculty, batch, and academic statuses
        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();
        $data['certificate-template'] = $this->activeCertificateTemplates();

        // Quick Services
        $data['hostels'] = $this->activeHostel();
        $data['routes'] = $this->activeTransportRoutes();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path . '.index'), compact('data'));
    }
}
