<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Fees;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Addressinfo;
use App\Models\Faculty;
use App\Models\FeeCollection;
use App\Models\FeeHead;
use App\Models\FeeMaster;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class FeesBaseController extends CollegeBaseController
{
    protected $base_route = 'account.fees';
    protected $view_path = 'account.fees';
    protected $panel = 'Fees Collection';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['feesCollection'] = FeeCollection::select('fee_collections.created_at','fee_collections.students_id', 'fee_collections.fee_masters_id',
                'fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
                'fee_collections.payment_mode','fee_collections.note','fee_collections.created_by','fee_collections.status as fc_status',
                'fm.status as fm_status','fm.fee_head',
                'students.reg_no','students.reg_date', 'students.first_name','students.middle_name', 'students.last_name','students.semester')
                ->where(function ($query) use ($request) {

                    $this->commonStudentFilterCondition($query, $request);

                    if ($request->has('fee_collection_date_start') && $request->has('fee_collection_date_end')) {
                        $query->whereBetween('fee_collections.date', [$request->get('fee_collection_date_start'), $request->get('fee_collection_date_end')]);
                        $this->filter_query['fee_collection_date_start'] = $request->get('fee_collection_date_start');
                        $this->filter_query['fee_collection_date_end'] = $request->get('fee_collection_date_end');
                    }
                    elseif ($request->has('fee_collection_date_start')) {
                        $query->where('fee_collections.date', '>=', $request->get('fee_collection_date_start'));
                        $this->filter_query['fee_collection_date_start'] = $request->get('fee_collection_date_start');
                    }
                    elseif($request->has('fee_collection_date_end')) {
                        $query->where('fee_collections.date', '<=', $request->get('fee_collection_date_end'));
                        $this->filter_query['fee_collection_date_end'] = $request->get('fee_collection_date_end');
                    }

                    if ($request->has('fee_heads') && $request->get('fee_heads') > 0) {
                        $query->where('fm.fee_head', '=',$request->fee_heads);
                        $this->filter_query['fm.fee_head'] = $request->fee_heads;
                    }

                    if ($request->has('payment_method') && $request->get('payment_method') !=null) {
                        $query->where('fee_collections.payment_mode', 'like', '%' . $request->payment_method . '%');
                        $this->filter_query['fee_collections.payment_mode'] = $request->payment_method;
                    }

                })
                ->join('students', 'students.id','=','fee_collections.students_id')
                ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
                ->orderBy('fee_collections.created_at','desc')
                ->paginate(env('PAGINATION_LIMIT',$this->pagination_limit));
        }else{
            $year = $this->getActiveYear();
            $data['feesCollection'] = FeeCollection::select('fee_collections.created_at','fee_collections.students_id', 'fee_collections.fee_masters_id',
                'fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
                'fee_collections.payment_mode','fee_collections.note','fee_collections.created_by','fee_collections.status as fc_status',
                'fm.status as fm_status','fm.fee_head',
                'students.reg_no','students.reg_date', 'students.first_name','students.middle_name', 'students.last_name','students.semester')
                //->whereYear('fee_collections.date', '=', $year)
                ->join('students', 'students.id','=','fee_collections.students_id')
                ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
                ->orderBy('fee_collections.created_at','desc')
                ->paginate(env('PAGINATION_LIMIT',$this->pagination_limit));
        }

        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();
        $data['payment_method'] = $this->activePaymentMethod();
        $data['fee_heads'] = $this->activeFeeHead();

        $data['village'] = $this->addressVillage();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        //dd($data['feesCollection']->toArray());

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    // public function balance(Request $request)
    // {
    //     $data = [];

    //     if($request->all()){
    //         $students = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
    //             'students.middle_name', 'students.last_name', 'students.student_image','students.status',
    //             'pd.father_first_name', 'pd.father_middle_name','pd.father_last_name','pd.father_mobile_1',
    //             'f.faculty','s.semester',
    //             'sgd.guardian_first_name','sgd.guardian_middle_name','sgd.guardian_last_name', 'sgd.guardian_mobile_1'
    //             )
    //             ->where(function ($query) use ($request) {
    //                 $this->commonStudentFilterCondition($query, $request);
    //                 if ($request->get('village') > 0) {
    //                     $query->where('ai.address', '=',  $request->village);
    //                     $this->filter_query['ai.address'] = $request->village;
    //                 }
    //             })
    //             ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
    //             ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
    //             ->join('faculties as f', 'f.id', '=', 'students.faculty')
    //             ->join('semesters as s', 's.id', '=', 'students.semester')
    //             ->join('student_guardians as sg', 'sg.students_id', '=', 'students.id')
    //             ->join('guardian_details as sgd', 'sgd.id', '=', 'sg.id')
    //             ->get();

    //         if($request->due_status == 'overdue'){
    //             /*filter Over due using call back*/
    //             $filtered  = $students->filter(function ($student) {
    //                 $date = Carbon::today()->format('Y-m-d');
    //                 $feeMaster = $student->feeMaster()->select('id as fee_master_id','fee_amount')->where('fee_due_date','<=',$date)->get();
    //                 $collection = FeeCollection::select('fee_collections.id','fee_collections.students_id','fee_collections.fee_masters_id', 'fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount')
    //                     ->where('fm.fee_due_date','<=',$date)
    //                     ->where('fee_collections.students_id','=',$student->id)
    //                     ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
    //                     ->get();

    //                 $student->fee_amount = $feeMaster->sum('fee_amount');
    //                 $student->paid_amount = $collection->sum('paid_amount');
    //                 $student->discount = $collection->sum('discount');
    //                 $student->fine = $collection->sum('fine');
    //                 $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
    //                 if($student->balance > 0){
    //                     return $student;
    //                 }
    //             });

    //         }else{
    //             /*filter due using call back*/
    //             $filtered  = $students->filter(function ($student) {
    //                 $student->fee_amount = $student->feeMaster()->sum('fee_amount');
    //                 $student->paid_amount = $student->feeCollect()->sum('paid_amount');
    //                 $student->discount = $student->feeCollect()->sum('discount');
    //                 $student->fine = $student->feeCollect()->sum('fine');
    //                 $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
    //                 if($student->balance > 0){
    //                     return $student;
    //                 }
    //             });

    //         };

    //         $data['student'] = $filtered;
    //     }



    //     $data['faculties'] = $this->activeFaculties();
    //     $data['batch'] = $this->activeBatch();
    //     $data['academic_status'] = $this->activeStudentAcademicStatus();
    //     $data['fee_heads'] = $this->activeFeeHead();
    //     $data['village'] = $this->addressVillage();
    //     $data['months'] = $this->activeMonths();

    //     $data['url'] = URL::current();
    //     $data['filter_query'] = $this->filter_query;

    //     return view(parent::loadDataToView($this->view_path.'.balance.index'), compact('data'));
    // }
    
     public function balance(Request $request)
    {
        $data = [];

        // Start Query
        $query = Student::with('SemesterData','AcademicStatusData','facultyData')->select(
            'students.id',
            'students.reg_no',
            'students.reg_date',
            'students.first_name',
            'students.middle_name',
            'students.last_name',
            'students.faculty',
            'students.gender',
            'students.blood_group',
            'students.date_of_birth',
            'students.university_reg',
            'students.nationality',
            'students.mother_tongue',
            'students.religion',
            'students.caste',
            'students.email',
            'students.status',
            'pd.father_first_name',
            'pd.father_middle_name',
            'pd.father_last_name',
            'pd.father_mobile_1',
            'f.faculty as program',
            's.semester',
            'sgd.guardian_first_name',
            'sgd.guardian_middle_name',
            'sgd.guardian_last_name',
            'sgd.guardian_mobile_1',
            'ai.address'
        )
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->join('faculties as f', 'f.id', '=', 'students.faculty')
            ->join('semesters as s', 's.id', '=', 'students.semester')
            ->join('student_guardians as sg', 'sg.students_id', '=', 'students.id')
            ->join('guardian_details as sgd', 'sgd.id', '=', 'sg.guardians_id');



        if ($request->filled('reg_no')) {
            $query->where('reg_no', 'like', "%{$request->reg_no}%");
        }

        if ($request->filled('reg_date_from') && $request->filled('reg_date_to')) {
            $query->whereBetween('students.reg_date', [$request->reg_date_from, $request->reg_date_to]);
        }

        if ($request->filled('status')) {
            $query->where('students.status', $request->status);
        }

        if ($request->filled('faculty')) {
            $query->where('students.faculty', $request->faculty);
        }

        if ($request->filled('semester')) {
            $query->where('students.semester', $request->semester);
        }

        if ($request->filled('batch')) {
            $query->where('students.batch', $request->batch);
        }

        if ($request->filled('name')) {
            $query->whereRaw("CONCAT(students.first_name, ' ', students.middle_name, ' ', students.last_name) LIKE ?", ["%{$request->name}%"]);
        }

        if ($request->filled('gender')) {
            $query->where('students.gender', $request->gender);
        }

        if ($request->filled('blood_group')) {
            $query->where('students.blood_group', $request->blood_group);
        }

        if ($request->filled('dob_from') && $request->filled('dob_to')) {
            $query->whereBetween('students.date_of_birth', [$request->dob_from, $request->dob_to]);
        }

        if ($request->filled('university_reg')) {
            $query->where('students.university_reg', 'like', "%{$request->university_reg}%");
        }

        if ($request->filled('nationality')) {
            $query->where('students.nationality', $request->nationality);
        }

        if ($request->filled('mother_tongue')) {
            $query->where('students.mother_tongue', $request->mother_tongue);
        }

        if ($request->filled('religion')) {
            $query->where('students.religion', $request->religion);
        }

        if ($request->filled('caste')) {
            $query->where('students.caste', $request->caste);
        }

        if ($request->filled('email')) {
            $query->where('students.email', 'like', "%{$request->email}%");
        }

        $students = $query->paginate(env('PAGINATION_LIMIT', 20));

        // return  $students;

        if ($request->due_status == 'overdue') {
            /* Filter Overdue */
            $filtered = $students->filter(function ($student) {
                $date = Carbon::today()->format('Y-m-d');

                // Get Fees Data
                $feeMaster = $student->feeMaster()->where('fee_due_date', '<=', $date)->get();
                $collection = FeeCollection::where('fee_collections.students_id', $student->id)
                    ->join('fee_masters as fm', 'fm.id', '=', 'fee_collections.fee_masters_id')
                    ->where('fm.fee_due_date', '<=', $date)
                    ->get();

                // Calculate balances
                $student->fee_amount = $feeMaster->sum('fee_amount');
                $student->paid_amount = $collection->sum('paid_amount');
                $student->discount = $collection->sum('discount');
                $student->fine = $collection->sum('fine');
                $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);

                return $student->balance > 0;
            });
        } else {
            /* Filter All Due Fees */
            $filtered = $students->filter(function ($student) {
                // Get Fees Data
                $student->fee_amount = $student->feeMaster()->sum('fee_amount');
                $student->paid_amount = $student->feeCollect()->sum('paid_amount');
                $student->discount = $student->feeCollect()->sum('discount');
                $student->fine = $student->feeCollect()->sum('fine');
                $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);

                return $student->balance > 0;
            });
        }


        $data['student'] = $filtered;


        $data['faculties'] = $this->activeFaculties();
        $data['batch'] = $this->activeBatch();
        $data['academic_status'] = $this->activeStudentAcademicStatus();
        $data['fee_heads'] = $this->activeFeeHead();
        $data['village'] = $this->addressVillage();
        $data['months'] = $this->activeMonths();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path . '.balance.index'), compact('data'));
    }

}
