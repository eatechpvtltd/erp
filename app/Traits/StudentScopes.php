<?php
namespace App\Traits;

use App\Models\Addressinfo;
use App\Models\Annexure;
use App\Models\Degree;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\DepartmentHead;
use App\Models\Month;
use App\Models\Placement;
use App\Models\Scholarship;
use App\Models\Semester;
use App\Models\Student;
use App\Models\StudentBatch;
use App\Models\StudentStatus;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait StudentScopes{

    use AccountingScope;



    public function getStudentById($id)
    {
        $student = Student::find($id);
        if ($student) {
            return $student->reg_no;
        }else{
            return "Unknown";
        }
    }

    public function getStudentIdByReg($reg_no)
    {
        $student = Student::where('reg_no',$reg_no)->first();
        if ($student) {
            return $student->id;
        }else{
            return "Unknown";
        }
    }

    public function getStudentNameById($id)
    {
        $student = Student::find($id);
        if ($student) {
            return $student->first_name .' '.$student->middle_name.' '.$student->last_name;
        }else{
            return "Unknown";
        }
    }

    public function getStudentRegById($id)
    {
        $student = Student::find($id);
        if ($student) {
            return $student->reg_no;
        }else{
            return "Unknown";
        }
    }

    /*public function getStudentRegById($reg)
    {
        $student = Student::where('reg_no',$reg)->first();
        if ($student) {
            return $student->reg_no;
        }else{
            return "Unknown";
        }
    }*/

    public function getStudentNameByReg($reg)
    {
        $student = Student::where('reg_no',$reg)->first();
        if ($student) {
            return $student->first_name .' '.$student->middle_name.' '.$student->last_name;
        }else{
            return "Unknown";
        }
    }

    public function getStudentAcademicStatusId($id)
    {
        $student = StudentStatus::find($id);
        if ($student) {
            return $student->title;
        }else{
            return "Unknown";
        }
    }

    public function getStudentBatchId($id)
    {
        $student = StudentBatch::find($id);
        if ($student) {
            return $student->title;
        }else{
            return "Unknown";
        }
    }

    public function getStudentMobileNumber($id)
    {
        $addressInfo = Addressinfo::where('students_id',$id)->first();
        if ($addressInfo) {
            return $addressInfo->mobile_1;
        }else{

        }
    }

    public function getAnnextureById($id)
    {
        $annexure = Annexure::find($id);
        if ($annexure) {
            return $annexure->title;
        }else{
            return "Unknown";
        }
    }

    //command filter condition
    public function commonStudentFilterCondition($query, $request)
    {
        if ($request->has('reg_no') && $request->get('reg_no') !=null) {
            $query->where('students.reg_no', 'like', '%' . $request->reg_no . '%');
            $this->filter_query['reg_no'] = $request->reg_no;
        }

        if ($request->has('reg_start_date') && $request->has('reg_end_date')) {
                $query->whereBetween('students.reg_date', [$request->get('reg_start_date'), $request->get('reg_end_date')]);
                $this->filter_query['reg_start_date'] = $request->get('reg_start_date');
                $this->filter_query['reg_end_date'] = $request->get('reg_end_date');
        } elseif ($request->has('reg_start_date')) {
            $query->where('students.reg_date', '=', $request->get('reg_start_date'));
            $this->filter_query['reg_start_date'] = $request->get('reg_start_date');
        } elseif ($request->has('reg_end_date')) {
            $query->where('students.reg_date', '=', $request->get('reg_end_date'));
            $this->filter_query['reg_end_date'] = $request->get('reg_end_date');
        }

        if ($request->get('faculty') > 0) {
            $query->where('students.faculty', '=', $request->faculty);
            $this->filter_query['faculty'] = $request->faculty;
        }

        if ($request->get('semester_select') > 0) {
            $query->where('students.semester', '=',  $request->semester_select);
            $this->filter_query['semester'] = $request->semester_select;
        }

        if ($request->get('batch') > 0) {
            $query->where('students.batch', '=',  $request->batch);
            $this->filter_query['batch'] = $request->batch;
        }

        if ($request->get('academic_status') > 0) {
            $query->where('students.academic_status', '=',  $request->academic_status);
            $this->filter_query['academic_status'] = $request->academic_status;
        }

        if ($request->has('status')) {
            $query->where('students.status', $request->status == 'active' ? 1 : 0);
            $this->filter_query['status'] = $request->get('status');
        }

        if ($request->has('first_name')) {
            $query->where('students.first_name', 'like', '%' . $request->first_name . '%');
            $this->filter_query['first_name'] = $request->first_name;
        }

        if ($request->has('middle_name')) {
            $query->where('students.middle_name', 'like', '%' . $request->middle_name . '%');
            $this->filter_query['middle_name'] = $request->middle_name;
        }

        if ($request->has('last_name')) {
            $query->where('students.last_name', 'like', '%' . $request->last_name . '%');
            $this->filter_query['last_name'] = $request->last_name;
        }

        if ($request->has('gender')) {
            $query->where('students.gender', 'like', '%' . $request->gender . '%');
            $this->filter_query['gender'] = $request->gender;
        }

        if ($request->has('blood_group')) {
            $query->where('students.blood_group', 'like', '%' . $request->blood_group . '%');
            $this->filter_query['blood_group'] = $request->blood_group;
        }

        if ($request->has('date_of_birth_start_date') && $request->has('date_of_birth_end_date')) {
            $query->whereBetween('students.date_of_birth', [$request->get('date_of_birth_start_date'), $request->get('date_of_birth_end_date')]);
            $this->filter_query['date_of_birth_start_date'] = $request->get('date_of_birth_start_date');
            $this->filter_query['date_of_birth_end_date'] = $request->get('date_of_birth_end_date');
        } elseif ($request->has('date_of_birth_start_date')) {
            $query->where('students.date_of_birth', '=', $request->get('date_of_birth_start_date'));
            $this->filter_query['date_of_birth_start_date'] = $request->get('date_of_birth_start_date');
        } elseif ($request->has('date_of_birth_end_date')) {
            $query->where('students.date_of_birth', '=', $request->get('date_of_birth_end_date'));
            $this->filter_query['date_of_birth_end_date'] = $request->get('date_of_birth_end_date');
        }

        if ($request->has('university_reg')) {
            $query->where('students.university_reg', 'like', '%' . $request->university_reg . '%');
            $this->filter_query['university_reg'] = $request->university_reg;
        }


        if ($request->has('religion')) {
            $query->where('students.religion', 'like', '%' . $request->religion . '%');
            $this->filter_query['religion'] = $request->religion;
        }

        if ($request->has('caste')) {
            $query->where('students.caste', 'like', '%' . $request->caste . '%');
            $this->filter_query['caste'] = $request->caste;
        }

        if ($request->has('nationality')) {
            $query->where('students.nationality', 'like', '%' . $request->nationality . '%');
            $this->filter_query['nationality'] = $request->nationality;
        }

        if ($request->has('national_id_1')) {
            $query->where('students.national_id_1', 'like', '%' . $request->national_id_1 . '%');
            $this->filter_query['national_id_1'] = $request->national_id_1;
        }

        if ($request->has('national_id_2')) {
            $query->where('students.national_id_2', 'like', '%' . $request->national_id_2 . '%');
            $this->filter_query['national_id_2'] = $request->national_id_2;
        }

        if ($request->has('national_id_3')) {
            $query->where('students.national_id_3', 'like', '%' . $request->national_id_3 . '%');
            $this->filter_query['national_id_3'] = $request->national_id_3;
        }

        if ($request->has('national_id_4')) {
            $query->where('students.national_id_4', 'like', '%' . $request->national_id_4 . '%');
            $this->filter_query['national_id_4'] = $request->national_id_4;
        }

        if ($request->has('mother_tongue')) {
            $query->where('students.mother_tongue', 'like', '%' . $request->mother_tongue . '%');
            $this->filter_query['mother_tongue'] = $request->mother_tongue;
        }
    }

    //text replace
    public function textReplace($student, $text)
    {
        $studentName = $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name;
        $grandFatherName = $student->grandfather_first_name . ' ' . $student->grandfather_middle_name . ' ' . $student->grandfather_last_name;
        $fatherName = $student->father_first_name . ' ' . $student->father_middle_name . ' ' . $student->father_last_name;
        //dd($student);
        $motherName = $student->mother_first_name . ' ' . $student->mother_middle_name . ' ' . $student->mother_last_name;
        $parentsName = $fatherName ? $fatherName : $motherName;
        $guardianName = $student->guardian_first_name . ' ' . $student->guardian_middle_name . ' ' . $student->guardian_last_name;

        $addressInfos = $student->address()->first();
        //dd($addressInfos);
        if($student->address){
            $permanentAddress = $addressInfos->address.', '.$addressInfos->state.', '.$addressInfos->country;
            $tempAddress = $addressInfos->temp_address.', '.$addressInfos->temp_state.', '.$addressInfos->temp_country;
        }else{
            $permanentAddress = '';
            $tempAddress = '';
        }


        $facultyData = Faculty::find($student->faculty);
        $faculty = $facultyData->faculty;
        $faculty_duration = $facultyData->duration;
        $faculty_registration_validate = $facultyData->registration_validate;
        $semesterData = Semester::find($student->semester);
        $semester = $semesterData?$semesterData->semester:'';

        //faculty head & department
        if($facultyData){
            $department = Department::select('departments.id as departmentID','departments.department')
                ->where('dp.faculty_id', $facultyData->id)
                ->join('department_programs as dp','dp.department_id', '=', 'departments.id')
                ->first();

            $departmentText = $department ? $department->department : '';
            $text = str_replace('{{department}}', $departmentText, $text);
            //$text = str_replace('{{department}}', Str::title($departmentText), $text);


        }

        if($department) {
            $departmetnHead = DepartmentHead::select('department_heads.id as departmentHeadId','department_heads.department_head')
                //->where('dhd.department_id',$department->departmentID)
                ->join('department_heads_department as dhd','dhd.department_head_id','=','department_heads.id')
                ->first();
            $departmentHeadText = $departmetnHead?$departmetnHead->department_head:'';
            $text = str_replace('{{department_head}}', $departmentHeadText, $text);
            //$text = str_replace('{{department_head}}', Str::title($departmentHeadText), $text);
        }

// FooBar

        $batchData = StudentBatch::find($student->batch);
        $batch = $batchData?$batchData->title:'';
        $year = Year::where('active_status',1)->first()->title;
        $regDate = Carbon::parse($student->reg_date)->format('d-m-Y');
        $dateOfBirth = Carbon::parse($student->date_of_birth)->format('d-m-Y');

        $text = str_replace('{{reg_no}}', $student->reg_no, $text);
        $dateOfBirthInWord = $this->dateToWord($dateOfBirth);

        $text = str_replace('{{reg_date}}', $regDate, $text);
        //$text = str_replace('{{reg_date}}', $regDate, $text);
        $text = str_replace('{{university_reg}}', $student->university_reg, $text);

        //$text = str_replace('{{faculty}}', Str::title($faculty), $text);
        $text = str_replace('{{faculty}}', $faculty, $text);
        $text = str_replace('{{faculty_duration}}', $faculty_duration, $text);
        $text = str_replace('{{registration_validate}}', $faculty_registration_validate, $text);


        $text = str_replace('{{semester}}', $semester, $text);
        $text = str_replace('{{batch}}', $batch, $text);
        $text = str_replace('{{year}}', $year, $text);
        $text = str_replace('{{academic_status}}', $this->getStudentAcademicStatusId($student->academic_status), $text);
        $text = str_replace('{{first_name}}', $student->first_name, $text);
        $text = str_replace('{{middle_name}}', $student->middle_name, $text);
        $text = str_replace('{{last_name}}', $student->last_name, $text);
        $text = str_replace('{{student_name}}', $studentName, $text);
        $text = str_replace('{{date_of_birth}}', $dateOfBirth, $text);
       $text = str_replace('{{date_of_birth_in_word}}', $dateOfBirthInWord, $text);

        $text = str_replace('{{gender}}', $student->gender, $text);
        $text = str_replace('{{blood_group}}', $student->blood_group, $text);
        $text = str_replace('{{religion}}', $student->religion, $text);
        $text = str_replace('{{caste}}', $student->caste, $text);

        $text = str_replace('{{nationality}}', $student->nationality, $text);
        $text = str_replace('{{national_id_1}}', $student->national_id_1, $text);
        $text = str_replace('{{national_id_2}}', $student->national_id_2, $text);
        $text = str_replace('{{national_id_3}}', $student->national_id_3, $text);
        $text = str_replace('{{national_id_4}}', $student->national_id_4, $text);

        $text = str_replace('{{mother_tongue}}', $student->mother_tongue, $text);
        $text = str_replace('{{email}}', $student->email, $text);
        $text = str_replace('{{country}}', $student->country, $text);
        $text = str_replace('{{address}}', $permanentAddress, $text);
        $text = str_replace('{{temp_address}}', $tempAddress, $text);
        $text = str_replace('{{home_phone}}', $student->home_phone, $text);
        $text = str_replace('{{mobile_1}}', $student->mobile_1, $text);
        $text = str_replace('{{mobile_2}}', $student->mobile_2, $text);
        $text = str_replace('{{grand_father_name}}', $grandFatherName, $text);
        $text = str_replace('{{father_name}}', $fatherName, $text);
        $text = str_replace('{{mother_name}}', $motherName, $text);
        $text = str_replace('{{parents_name}}', $parentsName, $text);
        $text = str_replace('{{guardian_name}}', $guardianName, $text);
        $text = str_replace('{{father_eligibility}}', $student->father_eligibility, $text);
        $text = str_replace('{{father_occupation}}', $student->father_occupation, $text);
        $text = str_replace('{{father_office}}', $student->father_office, $text);
        $text = str_replace('{{father_office_number}}', $student->father_office_number, $text);
        $text = str_replace('{{father_residence_number}}', $student->father_residence_number, $text);
        $text = str_replace('{{father_mobile_1}}', $student->father_mobile_1, $text);
        $text = str_replace('{{father_mobile_2}}', $student->father_mobile_2, $text);
        $text = str_replace('{{father_email}}', $student->father_email, $text);
        $text = str_replace('{{mother_eligibility}}', $student->mother_eligibility, $text);
        $text = str_replace('{{mother_occupation}}', $student->mother_occupation, $text);
        $text = str_replace('{{mother_office}}', $student->mother_office, $text);
        $text = str_replace('{{mother_office_number}}', $student->mother_office_number, $text);
        $text = str_replace('{{mother_residence_number}}', $student->mother_residence_number, $text);
        $text = str_replace('{{mother_mobile_1}}', $student->mother_mobile_1, $text);
        $text = str_replace('{{mother_mobile_2}}', $student->mother_mobile_2, $text);
        $text = str_replace('{{mother_email}}', $student->mother_email, $text);
        $text = str_replace('{{guardian_eligibility}}', $student->guardian_eligibility, $text);
        $text = str_replace('{{guardian_occupation}}', $student->guardian_occupation, $text);
        $text = str_replace('{{guardian_office}}', $student->guardian_office, $text);
        $text = str_replace('{{guardian_office_number}}', $student->guardian_office_number, $text);
        $text = str_replace('{{guardian_residence_number}}', $student->guardian_residence_number, $text);
        $text = str_replace('{{guardian_mobile_1}}', $student->guardian_mobile_1, $text);
        $text = str_replace('{{guardian_mobile_2}}', $student->guardian_mobile_2, $text);
        $text = str_replace('{{guardian_email}}', $student->guardian_email, $text);
        $text = str_replace('{{guardian_relation}}', $student->guardian_relation, $text);
        $text = str_replace('{{guardian_address}}', $student->guardian_address, $text);

        $text = str_replace('{{date_of_issue}}', $student->date_of_issue, $text);

        return $text;

    }


    public function getScholarshipById($id)
    {
        $scholarship = Scholarship::find($id);
        if ($scholarship) {
            return $scholarship->title;
        }else{
            return "";
        }
    }


    public function getDegreeById($id)
    {
        $degree = Degree::find($id);
        if ($degree) {
            return $degree->title;
        }else{
            return "";
        }
    }
    public function getPlacementCompanyById($id)
    {
        $placement = Placement::find($id);
        if ($placement) {
            return $placement->title;
        }else{
            return "";
        }
    }






}