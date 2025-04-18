<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Payroll;

use App\Http\Controllers\CollegeBaseController;
use App\Models\PayrollHead;
use App\Models\PayrollMaster;
use App\Models\Staff;
use App\Models\StaffDesignation;
use App\Traits\StaffScope;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class PayrollMasterController extends CollegeBaseController
{
    protected $base_route = 'account.payroll.master';
    protected $view_path = 'account.payroll.master';
    protected $panel = 'Payroll';
    protected $filter_query = [];

    use StaffScope;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['payroll_master'] = PayrollMaster::select('payroll_masters.id', 'payroll_masters.staff_id', 'payroll_masters.tag_line',
            'payroll_masters.payroll_head','payroll_masters.due_date','payroll_masters.amount','payroll_masters.status',
            'staff.id as staff_id','staff.reg_no', 'staff.first_name',  'staff.middle_name', 'staff.last_name',
            'staff.mobile_1','staff.designation')
            ->where(function ($query) use ($request) {

                $this->commonStaffFilterCondition($query, $request);

                if ($request->has('payroll_due_date_start') && $request->has('payroll_due_date_end')) {
                    $query->whereBetween('payroll_masters.due_date', [$request->get('payroll_due_date_start'), $request->get('payroll_due_date_end')]);
                    $this->filter_query['payroll_due_date_start'] = $request->get('payroll_due_date_start');
                    $this->filter_query['payroll_due_date_end'] = $request->get('payroll_due_date_end');
                } elseif ($request->has('payroll_due_date_start')) {
                    $query->where('payroll_masters.due_date', '>=', $request->get('payroll_due_date_start'));
                    $this->filter_query['payroll_due_date_start'] = $request->get('payroll_due_date_start');
                } elseif ($request->has('payroll_due_date_end')) {
                    $query->where('payroll_masters.due_date', '<=', $request->get('payroll_due_date_end'));
                    $this->filter_query['payroll_due_date_end'] = $request->get('payroll_due_date_end');
                }

                if ($request->has('payroll_heads') && $request->get('payroll_heads') > 0) {
                    $query->where('payroll_masters.payroll_head', '=', $request->payroll_heads);
                    $this->filter_query['payroll_head'] = $request->payroll_heads;
                }

                if ($request->has('amount_start') && $request->has('amount_end')) {
                    $query->whereBetween('payroll_masters.amount', [$request->get('amount_start'), $request->get('amount_end')]);
                    $this->filter_query['amount_start'] = $request->get('amount_start');
                    $this->filter_query['amount_end'] = $request->get('amount_end');
                } elseif ($request->has('amount_start')) {
                    $query->where('payroll_masters.amount', '>=', $request->get('amount_start'));
                    $this->filter_query['amount_start'] = $request->get('amount_start');
                } elseif ($request->has('amount_end')) {
                    $query->where('payroll_masters.amount', '<=', $request->get('amount_end'));
                    $this->filter_query['amount_end'] = $request->get('amount_end');
                }
            })
            ->join('staff','staff.id','=','payroll_masters.staff_id')
            ->orderBy('payroll_masters.due_date','desc')
            ->paginate(env('PAGINATION_LIMIT',$this->pagination_limit));

        $data['designation'] = $this->staffDesignationList();
        $data['payroll_heads'] =  $this->activePayrollHead();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['staff'] = Staff::select('id', 'reg_no', 'join_date', 'first_name', 'middle_name', 'last_name',
                'father_name', 'designation', 'mobile_1', 'staff_image','basic_salary', 'status')
                ->where(function ($query) use ($request) {
                    $this->commonStaffFilterCondition($query, $request);
                })
                ->get();
        }


        $data['designation'] = $this->staffDesignationList();
        $data['payrollType'] = $request->payrollType;
        //dd($data['payrollType']);

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

//        if($request->payrollType = 'attendance_payroll'){
//            return view(parent::loadDataToView($this->view_path.'.attendancebase-add'), compact('data'));
//        }else{
//            return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
//        }

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));


    }

    public function store(Request $request)
    {
        if ($request->has('chkIds')) {
            foreach ($request->get('chkIds') as $key=> $row_id) {
                $row_id = decrypt($row_id);
                $row = Staff::find($row_id);
               // dd($row->toArray());
                $statusTag = 'false';

                if($request->get('payroll_type') == "manual_payroll"){
                    if ($row && $request->has('payroll_head')) {
                        foreach ($request->get('payroll_head') as $key => $payroll_head) {
                            PayrollMaster::create([
                                'staff_id' => $row->id,
                                'tag_line' => $request->get('tag_line')[$key],
                                'payroll_head' => $request->get('payroll_head')[$key],
                                'due_date' => $request->get('due_date')[$key],
                                'amount' => $request->get('amount')[$key],
                                'created_by' => auth()->user()->id,
                            ]);
                        }
                        $statusTag = 'true';
                    }else {
                        $request->session()->flash($this->message_warning, 'Please, Add Payroll Master at least one row.');
                        return redirect()->route($this->base_route);
                    }
                }
                if($request->get('payroll_type') == "attendance_payroll"){
                    $payrollHead = PayrollHead::where('title','ATTENDANCE BASE')->first();
                    if(!isset($payrollHead)){
                        $payrollHead = PayrollHead::create([
                            'title'=>'ATTENDANCE BASE',
                            'slug'=>str_slug('ATTENDANCE BASE'),
                            'created_by' => auth()->user()->id,
                        ]);

                    }
                    $payrollHeadId = $payrollHead->id;

                    $amountAdd = $request->get('time')[$key] * $request->get('basic_salary')[$key];

                    if ($amountAdd > 0) {
                        PayrollMaster::create([
                            'staff_id' => $row->id,
                            'tag_line' => $request->get('tag_line')[$key],
                            'payroll_head' => $payrollHeadId,
                            'due_date' => $request->get('due_date')[$key],
                            'amount' => $amountAdd,
                            'created_by' => auth()->user()->id,
                        ]);
                        $statusTag = 'true';
                    } else {
                        $request->session()->flash($this->message_warning, 'Payroll Amount Calculate According To Basic Salary X Number of Days. Your Calculated Amount is Less Than 0.');
                    }

                }

            }
            if($statusTag == 'true') {
                $request->session()->flash($this->message_success, $this->panel . ' Add Successfully.');
            }else{
                $request->session()->flash($this->message_warning, 'Some thing is Wrong.');
            }
        }else {
            $request->session()->flash($this->message_warning, 'Please, check at least one '.$this->panel);
        }

        return redirect()->back();

    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);
        $data = [];
        $data['row'] = PayrollMaster::select('id', 'staff_id', 'tag_line', 'payroll_head','due_date','amount','status')
            ->where('id','=',$id)
            ->first();
        if (!$data['row'])
            return parent::invalidRequest();

        $data['payroll_heads'] = [];
        $data['payroll_heads'][0] = 'Select Payroll Head';
        foreach (PayrollHead::select('id', 'title')->Active()->get() as $payroll) {
            $data['payroll_heads'][$payroll->id] = $payroll->title;
        }

        $data['designation'] = $this->staffDesignationList();
        $data['payrollType'] = $request->payrollType;
        $data['url'] = URL::current();
        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = PayrollMaster::find($id)) return parent::invalidRequest();

        $row->update([
            'tag_line' => $request->get('tag_line'),
            'payroll_head' => $request->get('payroll_head'),
            'due_date' => $request->get('due_date'),
            'amount' => $request->get('amount'),
            'last_updated_by' => auth()->user()->id,
        ]);
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = PayrollMaster::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

   public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = PayrollMaster::find(decrypt($row_id));
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = PayrollMaster::find(decrypt($row_id));
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $this->panel.' '.ucfirst($request->get('bulk_action')) . ' Successfully.');
                else
                    $request->session()->flash($this->message_success, $this->panel.' '.ucfirst($request->get('bulk_action')).' successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, check at least one '.$this->panel);
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function payrollHtmlRow()
    {
        $payroll_heads = [];
        $payroll_heads[0] = 'Select Payroll Head';
        foreach (PayrollHead::select('id', 'title')->Active()->get() as $payroll) {
            $payroll_heads[$payroll->id] = $payroll->title;
        }
        $response['html'] = view($this->view_path.'.includes.payroll_tr', [
            'payroll_heads' => $payroll_heads
        ])->render();
        return response()->json(json_encode($response));

    }

}
