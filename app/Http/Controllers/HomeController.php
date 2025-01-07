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

use App\Charts\FeeCompareChart;
use App\Charts\FeesChart;
use App\Charts\TransactionChart;
use App\Mail\EmailAlerts;
use App\Models\AttendanceMaster;
use App\Models\Attendence;
use App\Models\AttendenceMaster;
use App\Models\Bed;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\ExamSchedule;
use App\Models\Faculty;
use App\Models\FeeCollection;
use App\Models\FeeMaster;
use App\Models\Notice;
use App\Models\PaymentSetting;
use App\Models\SalaryPay;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\Web\WebMenu;
use App\Models\Web\WebPage;
use App\Models\Year;
use App\Models\Role;
use App\Traits\PurchaseVerification;
use App\Traits\StudentScopes;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use ViewHelper;

class HomeController extends CollegeBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use StudentScopes;
    use PurchaseVerification;

    protected $base_route = 'home';
    protected $view_path = 'dashboard';
    protected $panel;
    protected $filter_query = [];



    public function __construct()
    {
        $this->panel = __('dashboard.name');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*$data['payment_setting'] = PaymentSetting::where('status',1)->get();
           $paymentGateway = json_decode($data['payment_setting'],true);
           dd($data['payment_setting']);
           dd($paymentGateway);

            dd(collect(array_pluck($paymentGateway,'status','identity')));*/

//        $token = "test_secret_key_22d2d49601d64461b57b448cb5eb4c95";
//        $secretKey = "test_secret_key_22d2d49601d64461b57b448cb5eb4c95";
//        $publictKey = "test_public_key_df221a6ddfac407daba868fb2a356aad";
//
//        $args = http_build_query(array(
//            'token' => 'VGMyaKVDQQyorBiQ3W99WL',
//            'amount' => 1000
//        ));
//
//        $url = "https://khalti.com/api/v2/payment/verify/";
//
//        # Make the call using API.
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        $headers = ['Authorization: Key test_secret_key_f59e8b7d18b4499ca40f68195a846e9b'];
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//
//        // Response
//        $response = curl_exec($ch);
//        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        curl_close($ch);
//
//       dd($response);

        //[{"label":"Training Fee","value":"Training Fee"},{"label":"Support","value":"Support"},{"label":"Software Services","value":"Software Services"},{"label":"Domain / Hosting","value":"Domain / Hosting"},{"label":"Development","value":"Development"},{"label":"Goods Purchase","value":"Goods Purchase"},{"label":"Bulk SMS","value":"Bulk SMS"},{"label":"Others","value":"Others"}]










        //start
        $data = [];
        $year = Year::where('active_status','=',1)->first();
        if($year){
            $activeYear = $year->title;
        }else{
            $activeYear = '0000';
            request()->session()->flash($this->message_success, 'Please, Create Year and Active');
        }

            // start range 7 days ago
            //$start = date('z') + 1 - 7;
            $start = date('z') + 1 ;
            // end range 7 days from now
            $end = date('z') + 1 + 10;
            $data['student_birthday'] = Student::select('id','reg_no','first_name','middle_name','last_name','faculty','semester','date_of_birth')
                                        ->whereRaw("DAYOFYEAR(date_of_birth) BETWEEN $start AND $end")
                                        ->orderBy('date_of_birth','asc')
                                        ->paginate(env('PAGINATION_LIMIT',$this->pagination_limit));
            $data['staff_birthday'] = Staff::select('id','reg_no','first_name','middle_name','last_name','designation','date_of_birth')
                                        ->whereRaw("DAYOFYEAR(date_of_birth) BETWEEN $start AND $end")
                                        ->orderBy('date_of_birth','asc')
                                        ->paginate(env('PAGINATION_LIMIT',$this->pagination_limit));


        //$birthdayStudent = Student::where('date_of_birth',)

        $userRoleId = auth()->user()->roles()->first()->id;
        /*Notice*/
        $now = date('Y-m-d');
        $data['notice_display'] = Notice::select('last_updated_by', 'title', 'message',  'publish_date', 'end_date',
            'display_group', 'status')
            ->where('display_group','like','%'.$userRoleId.'%')
            ->where('publish_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->latest()
            ->get();

        /*Indicators*/
        $data['studentIndicator'] = Student::count();
        $data['staffIndicator'] = Staff::count();
        $data['feeCollectionIndicator'] = FeeCollection::sum('paid_amount');
        $data['salaryPayIndicator'] = SalaryPay::sum('paid_amount');

        /*Accounting*/
        $data['recent_fees_collection'] = FeeCollection::select('fee_collections.date','fee_collections.students_id', 'fee_collections.fee_masters_id',
            'fee_collections.paid_amount', 's.reg_no', 'fh.fee_head_title')
            ->join('students as s','s.id','=','fee_collections.students_id')
            ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
            ->join('fee_heads as fh', 'fh.id', '=','fm.fee_head')
            ->latest('fee_collections.created_at')
            ->limit(10)
            ->get();

        $data['recent_payroll_pay'] = SalaryPay::select('salary_pays.date','salary_pays.staff_id',
            'salary_pays.salary_masters_id', 'salary_pays.paid_amount', 's.reg_no', 'ph.title')
            ->join('staff as s','s.id','=','salary_pays.staff_id')
            ->join('payroll_masters as pm','pm.id','=','salary_pays.salary_masters_id')
            ->join('payroll_heads as ph', 'ph.id', '=','pm.payroll_head')
            ->latest('salary_pays.created_at')
            ->limit(10)
            ->get();

        $data['recent_transaction'] = Transaction::select('transactions.date', 'transactions.tr_head_id',
            'transactions.dr_amount','transactions.cr_amount', 'th.tr_head')
            ->join('transaction_heads as th','th.id','=','transactions.tr_head_id')
            ->latest('transactions.created_at')
            ->limit(10)
            ->get();

        /*Library*/
        $data['book_issued'] = BookIssue::select('book_issues.member_id','book_issues.issued_on', 'book_issues.due_date',
            'b.book_code', 'bm.id as bookmaster_id','bm.title', 'lm.member_id as lib_id','lm.user_type')
            ->where('book_issues.return_date',null)
            ->latest('book_issues.created_at')
            ->join('books as b','b.id','=','book_issues.book_id')
            ->join('book_masters as bm','bm.id','=','b.book_masters_id')
            ->join('library_members as lm','lm.id','=','book_issues.member_id')
            ->get();

        $data['book_return_over'] = BookIssue::select('book_issues.member_id','book_issues.issued_on', 'book_issues.due_date',
            'b.book_code', 'bm.id as bookmaster_id','bm.title', 'lm.member_id as lib_id', 'lm.user_type')
            ->where('book_issues.status','=',1)
            ->where('book_issues.due_date',"<", Carbon::now())
            ->join('books as b','b.id','=','book_issues.book_id')
            ->join('book_masters as bm','bm.id','=','b.book_masters_id')
            ->join('library_members as lm','lm.id','=','book_issues.member_id')
            ->get();

        /*Attendence*/
        $data['attendance_booklet'] = AttendanceMaster::select('id', 'year', 'month', 'day_in_month','holiday','open','status')
            ->limit(12)
            ->orderBy('year','desc')
            ->orderBy('month', 'asc')
            ->get();

        /*FOR Summary Right WIDGET*/
        //$studentData = Student::Active()->get()->toArray();
        //dd($studentData);
        $data['student_faculty_active_status'] = Student::select('students.faculty as faculty_ID','students.semester as semester_ID','f.faculty as faculty','s.semester as semester', DB::raw('count(*) as total'))
            ->groupBy('students.faculty','students.semester')
            ->where('students.status',1)
            ->join('faculties as f','f.id','=','students.faculty')
            ->join('semesters as s','s.id','=','students.semester')
            ->OrderBy('f.faculty','asc')
            ->OrderBy('s.semester','asc')
            ->get();

        $data['student_faculty_wise_active_status'] = $data['student_faculty_active_status']->groupBy('faculty');

//        dd();
//
//        dd($data['student_active_status']->toArray());
//
//        $faculties = Faculty::select('faculties.id','faculties.faculty','semesters.semester')
//            ->join('students as s','lm.id','=','book_issues.member_id')
//            ->Active()->get();
//
//        $filterFaculties = $faculties->filter(function ($faculty, $key){
//                                   $semesters =  $faculty->semester()->select('semesters.id','semesters.semester')->get();
//
//                                   $filterSemester = $semesters->filter(function ($faculty, $key){
//
//                                                       });
//                                   dd($semesters->pluck('id'));
//                            });
//
//
//        $data['student_active_faculty_semester'] = Student::select('faculty', 'semester')
//            //->groupBy('status')
//            ->Active()
//            ->get()
//            ->toArray();
//
//        dd($data['student_active_faculty_semester']);

        $data['student_active_status'] = Student::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $data['academic_status_count'] = Student::select('academic_status', DB::raw('count(*) as total'))
            ->groupBy('academic_status')
            ->get();

        $data['staff_status'] = Staff::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $data['books_status'] = Book::select('book_status', DB::raw('count(*) as total'))
            ->groupBy('book_status')
            ->get();

        $data['bed_status'] = Bed::select('bed_status', DB::raw('count(*) as total'))
            ->groupBy('bed_status')
            ->get();

        $data['transport_status'] = Vehicle::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $data['exams_status'] = ExamSchedule::select('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'status')
            ->groupBy('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'status')
            ->orderBy('years_id', 'desc')
            ->orderBy('months_id', 'asc')
            ->limit (10)
            ->get()
            ->count();

        /*Fees chart*/
        $monthBase = [0,0,0,0,0,0,0,0,0,0,0,0];
        $feeMonthly = DB::table('fee_collections')
            ->select(DB::raw('MONTH(date) as month'),DB::raw('YEAR(date) as year'), DB::raw('sum(paid_amount) as total'))
            ->whereYear('date', '=', $activeYear)
            ->groupBy(DB::raw('YEAR(date)') , DB::raw('MONTH(date)') )
            ->get();

        foreach ($feeMonthly as $value){
            $monthBase = data_set($monthBase,$value->month-1,$value->total);
        }
        $feeMonthly = $monthBase;

        /*Salary Chart*/
        $monthBase = [0,0,0,0,0,0,0,0,0,0,0,0];
        $salaryMonthly = DB::table('salary_pays')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('sum(paid_amount) as total'))
            ->whereYear('date', '=', $activeYear)
            ->groupBy(DB::raw('MONTH(date)') )
            ->get();

        foreach ($salaryMonthly as $value){
            $monthBase = data_set($monthBase,$value->month-1,$value->total);
        }
        $salaryMonthly = $monthBase;

        /*fee salary chart*/
        $data['feeSalaryChart'] = new FeesChart();
        $data['feeSalaryChart']->dataset('Fee Collection', 'bar', $feeMonthly)
            ->options(['borderColor' => '#46b8da', 'backgroundColor'=>'#46b8da' ]);

        $data['feeSalaryChart']->dataset('Salary', 'bar', $salaryMonthly)
            ->options(['borderColor' => '#FF6384', 'backgroundColor'=>'#FF6384']);

        /*toral fees collection and due compare*/
        $feeMaster = FeeMaster::sum('fee_amount');
        $feeCollection = FeeCollection::sum('paid_amount');
        $dueFee = $feeMaster - $feeCollection;
        /*chart*/
        $data['feeCompare'] = new FeeCompareChart();
        $data['feeCompare']->dataset('Income', 'doughnut',[$feeCollection, $dueFee])
            ->options(['borderColor' => '#46b8da', 'backgroundColor'=>['#46b8da','#FF6384'] ]);

        /*Transaction Chart*/
        $monthBase = [0,0,0,0,0,0,0,0,0,0,0,0];
        $drTransaction = DB::table('transactions')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('sum(dr_amount) as total'))
            ->whereYear('date', '=', $activeYear)
            ->groupBy(DB::raw('MONTH(date)') )
            ->get();

        foreach ($drTransaction as $value){
            $monthBase = data_set($monthBase,$value->month-1,$value->total);
        }
        $drTransaction = $monthBase;

        /*cr*/
        $monthBase = [0,0,0,0,0,0,0,0,0,0,0,0];
        $crTransaction = DB::table('transactions')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('sum(cr_amount) as total'))
            ->whereYear('date', '=', $activeYear)
            ->groupBy(DB::raw('MONTH(date)') )
            ->get();
        foreach ($crTransaction as $value){
            $monthBase = data_set($monthBase,$value->month-1,$value->total);
        }
        $crTransaction = $monthBase;

        $data['transactionChart'] = new TransactionChart();
        $data['transactionChart']->dataset('Debit', 'line',$drTransaction)
            ->options(['borderColor' => '#46b8da', 'backgroundColor'=>'transparent' ]);
        $data['transactionChart']->dataset('Credit', 'line',$crTransaction)
            ->options(['borderColor' => '#FF6384', 'backgroundColor'=>'transparent' ]);



        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));

    }

    public function welcome(){

        $data =[];
        if(Auth::check()){
            return redirect()->route('dashboard');
        }else{
            $data = [];
            $data['menus'] = WebMenu::where('slug','=', 'welcome_menu')->first();
            $data['pages'] = WebPage::where('status', 1)->orderBy('title','asc')->get();
            $data['welcome_menu'] = $data['menus']->pages()->orderBy('rank')->get();
            return view(parent::loadDataToView('welcome'), compact('data'));
        }
    }

}
