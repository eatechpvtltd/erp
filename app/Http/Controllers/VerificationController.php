<?php

/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests\Student\Registration\AddValidation;
use App\Http\Requests\Student\Registration\EditValidation;
use App\Models\AcademicInfo;
use App\Models\Addressinfo;
use App\Models\AlertSetting;
use App\Models\Annexure;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\CertificateTemplate;
use App\Models\Document;
use App\Models\ExamSchedule;
use App\Models\Faculty;
use App\Models\GuardianDetail;
use App\Models\LibraryMember;
use App\Models\Note;
use App\Models\ParentDetail;
use App\Models\ResidentHistory;
use App\Models\Role;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentAddressinfo;
use App\Models\StudentAnnexure;
use App\Models\StudentDegree;
use App\Models\StudentExtraInfo;
use App\Models\StudentGuardian;
use App\Models\StudentParent;
use App\Models\StudentPlacement;
use App\Models\StudentScholarship;
use App\Models\StudentStatus;
use App\Models\StudentSubject;
use App\Models\SubjectAttendance;
use App\Models\TransportHistory;
use App\Models\Year;
use App\Traits\AcademicScope;
use App\Traits\CertificateScope;
use App\Traits\LibraryScope;
use App\Traits\SmsEmailScope;
use App\Traits\UserScope;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use Maatwebsite\Excel\Facades\Excel;
use URL;
use ViewHelper;
use function App\Http\Controllers\Student\public_path;
use function App\Http\Controllers\Student\str_random;

class VerificationController extends CollegeBaseController
{
    protected $base_route = 'verification';
    protected $view_path = 'verification';
    protected $panel;
    protected $folder_path;
    protected $folder_name = 'studentProfile';
    protected $filter_query = [];

    use SmsEmailScope;
    use UserScope;
    use LibraryScope;
    use AcademicScope;
    use CertificateScope;

    public function __construct()
    {
        $this->panel = __('student_staff.child.student.name');
    }

    public function certificate(Request $request)
    {

        $data = [];

        if($request->all()) {
            $student = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
                'students.faculty','students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
                'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group',  'students.religion', 'students.caste','students.nationality',
                'students.mother_tongue', 'students.email', 'students.extra_info', 'students.status',
                'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
                'ai.mobile_1', 'ai.mobile_2',
                'pd.grandfather_first_name',
                'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name', 'pd.father_middle_name',
                'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation', 'pd.father_office', 'pd.father_office_number',
                'pd.father_residence_number', 'pd.father_mobile_1', 'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name',
                'pd.mother_middle_name', 'pd.mother_last_name', 'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office',
                'pd.mother_office_number', 'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',
                'gd.id as guardian_id', 'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
                'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number', 'gd.guardian_residence_number',
                'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email', 'gd.guardian_relation', 'gd.guardian_address',
                'students.student_image','students.student_signature', 'pd.father_image', 'pd.mother_image', 'gd.guardian_image',
                'cc.id as certificate_id','cc.date_of_issue', 'cc.course', 'cc.period', 'cc.character', 'cc.ref_text')
                ->where(function ($query) use ($request) {
                        if ($request->has('reg_no') && $request->get('reg_no') != null) {
                            $query->where('students.reg_no', $request->reg_no);
                            $this->filter_query['reg_no'] = $request->reg_no;
                        }

                        if ($request->has('first_name')) {
                            $query->where('students.first_name', 'like', '%' . $request->first_name . '%');
                            $this->filter_query['first_name'] = $request->first_name;
                        }

                        if ($request->has('date_of_birth')) {
                            $query->where('students.date_of_birth', $request->date_of_birth);
                            $this->filter_query['date_of_birth'] = $request->date_of_birth;
                        }
                    })
                ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                ->join('course_completion_certificates as cc', 'cc.students_id', '=', 'students.id')
                ->first();

            if(isset($student)) {
                $certificateTemplate = CertificateTemplate::where(['id' => $request->get('certificate'),'public_verify' => 1])->first();
                if(isset($certificateTemplate)){
                    $issueStatus = $this->studentCertificateIssuedStatus($student, $certificateTemplate->certificate);
                    if (isset($issueStatus)) {
                        $certificateContent = $this->studentCertificateTextReplace($student,$certificateTemplate);
                        $data['certificate_template'] = $certificateTemplate;
                        $data['certificateContent'] = $certificateContent;
                    } else {
                        $request->session()->flash($this->message_warning, 'Dear Verifier, We are unable to found Certificate with your provided information.');
                    }
                }else{
                    $request->session()->flash($this->message_warning, 'Dear Verifier, Verification is not provided for this certificate. For More Info Contact our Institution.');
                }
            }else {
                $request->session()->flash($this->message_warning, 'Dear Verifier, We are unable to found Certificate with your provided information.');
            }

        }

        $template = CertificateTemplate::where('public_verify',1)->Active()->orderBy('certificate')->pluck('certificate','id')->toArray();
        $data['certificate-template'] =  array_prepend($template,'Select Certificate','');

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.certificate.index'), compact('data'));
    }

}
