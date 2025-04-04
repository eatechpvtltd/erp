<?php
namespace App\Exports;

use App\Models\Student;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentsExport implements FromView
{
    protected $ids;

    public function __construct($dataIds)
    {
        $this->ids = $dataIds;

    }

    public function view(): View
    {
        $students = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty', 'students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group', 'students.nationality',
            'students.mother_tongue', 'students.email', 'students.extra_info', 'students.status',

            'pd.grandfather_first_name', 'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name',
            'pd.father_middle_name', 'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation',
            'pd.father_office', 'pd.father_office_number', 'pd.father_residence_number', 'pd.father_mobile_1',
            'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name', 'pd.mother_middle_name', 'pd.mother_last_name',
            'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office', 'pd.mother_office_number',
            'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',

            'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
            'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number',
            'gd.guardian_residence_number', 'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email',
            'gd.guardian_relation', 'gd.guardian_address',

            'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
            'ai.mobile_1', 'ai.mobile_2',

            'ei.total_fee_per_year', 'ei.bank_name', 'ei.bank_code', 'ei.bank_account_number',
            'ei.admission_portal_login_id', 'ei.admission_portal_login_password',

            'ss.scholarships_id', 'ss.scholarship_application_id', 'ss.scholarship_user_name', 'ss.scholarship_password',

            'pl.placements_id', 'pl.placement_date', 'pl.placement_salary', 'pl.placement_location', 'pl.placement_designation'

            )
            ->whereIn('students.id',$this->ids)
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('student_guardians as sg', 'sg.students_id','=','students.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->join('student_extra_infos as ei', 'ei.students_id','=','students.id')
            ->join('student_scholarships as ss', 'ss.students_id','=','students.id')
            ->join('student_placements as pl', 'pl.students_id','=','students.id')
            ->distinct('students.id')
            ->get();


        return view('exports.student', [
            'students' => $students
        ]);
    }
}