<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Library;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Library\Member\AddValidation;
use App\Http\Requests\Library\Member\EditValidation;
use App\Models\AlertSetting;
use App\Models\LibraryCirculation;
use App\Models\LibraryMember;
use App\Models\Staff;
use App\Models\Student;
use App\Traits\LibraryScope;
use App\Traits\SmsEmailScope;
use Illuminate\Http\Request;
use URL;

class MemberController extends CollegeBaseController
{
    protected $base_route = 'library.member';
    protected $view_path = 'library.member';
    protected $panel = 'Members';
    protected $filter_query = [];

    use SmsEmailScope;
    use LibraryScope;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['member'] = LibraryMember::select('id', 'user_type', 'member_id', 'status')
            ->where(function ($query) use ($request) {

                if ($request->has('user_type')) {
                    $query->where('user_type', '=', $request->user_type);
                    $this->filter_query['user_type'] = $request->user_type;
                }

                if ($request->reg_no != null) {
                    if($request->get('user_type') !== '' & $request->get('user_type') > 0){
                        if($request->has('user_type') == 1){
                            $studentId = $this->getStudentIdByReg($request->reg_no);
                            $query->where('member_id', '=', $studentId);
                            $this->filter_query['member_id'] = $studentId;
                        }
                        if($request->has('user_type') == 2){
                            $staffId = $this->getStaffByReg($request->reg_no);
                            $query->where('member_id', '=', $studentId);
                            $this->filter_query['member_id'] = $staffId;
                        }
                    }

                }

                if ($request->has('status')) {
                    $query->where('status', $request->status == 'active'?1:0);
                    $this->filter_query['status'] = $request->get('status');
                }

            })
            ->paginate(env('PAGINATION_LIMIT',$this->pagination_limit));

        $data['circulation'] = [];
        $data['circulation'][0] = 'Select Member Type';
        foreach (LibraryCirculation::select('id', 'user_type')->get() as $circulation) {
            $data['circulation'][$circulation->id] = $circulation->user_type;
        }


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];
        $data['member'] = LibraryMember::select('id', 'user_type', 'member_id', 'status')->get();

        $data['circulation'] = [];
        foreach (LibraryCirculation::select('id', 'user_type')->get() as $circulation) {
            $data['circulation'][$circulation->id] = $circulation->user_type;
        }


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        $data['reg_no'] = '';

        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        if($request->get('user_type') && $request->has('reg_no')){
            switch ($request->get('user_type')){
                case 1:
                    $data = Student::where('reg_no','=',$request->reg_no)->first();
                break;
                case 2:
                    $data = Staff::where('reg_no','=',$request->reg_no)->first();
                break;
                default:
                    return parent::invalidRequest();
            }
        }
        
        if($data){
            $currentMember = LibraryMember::where(['user_type' => $request->user_type, 'member_id' => $data->id])->orderBy('id','desc')->first();
            if(!$currentMember){
                $request->request->add(['member_id' => $data->id]);
                $request->request->add(['created_by' => auth()->user()->id]);
                $member = LibraryMember::create($request->all());

                $memberId = $member->member_id;
                $userType = $member->user_type;
                $this->sendLibraryRegistrationAlert($memberId,$userType);

                $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
            }else{
                $request->session()->flash($this->message_warning,'Member already registered. Please find and edit.');
                return back();
            }
        }else{
            $request->session()->flash($this->message_warning,'Registration Number or User Type is not Valid.');
        }

        if($request->add_member_another) {
            return back();
        }else{
            return redirect()->route($this->base_route);
        }

    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = LibraryMember::find($id))
            return parent::invalidRequest();

        if($data['row']->user_type == 1){
            $data['reg_no'] = Student::find($data['row']->member_id)->reg_no;
        }

        if($data['row']->user_type == 2){
            $data['reg_no'] = Staff::find($data['row']->member_id)->reg_no;
        }

        $data['circulation'] = [];
        $data['circulation'][0] = 'Select Category';
        foreach (LibraryCirculation::select('id', 'user_type')->get() as $circulation) {
            $data['circulation'][$circulation->id] = $circulation->user_type;
        }

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.edit'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        if (!$row = LibraryMember::find($id)) return parent::invalidRequest();

        /*User Type and User Verification. only valid student or staff will get membership*/
        if($request->get('user_type') && $request->has('reg_no')){
            switch ($request->get('user_type')){
                case 1:
                    $data = Student::where('reg_no','=',$request->reg_no)->first();
                break;
                case 2:
                    $data = Staff::where('reg_no','=',$request->reg_no)->first();
                break;
                default:
                    return parent::invalidRequest();
            }
        }
        
        if($data){
            if($row->id == $data->id) {
                $row->last_updated_by = auth()->user()->id;
                $row->member_id = $data->id;
                $row->status = $request->status == 'active' ? 'active' : 'in-active';
                $row->save();
            }

            $request->session()->flash($this->message_success, $this->panel. ' Updated Successfully.');
            return redirect()->route($this->base_route);
        }else{
            $request->session()->flash($this->message_warning,'Registration Number or User Type is not Valid.');
            return back();
        }
    }

    public function delete(Request $request, $id)
    {
        if (!$row = LibraryMember::find($id)) return parent::invalidRequest();

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
                            $row = LibraryMember::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = LibraryMember::find($row_id);
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

    public function active(request $request, $id)
    {
        if (!$row = LibraryMember::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);
        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = LibraryMember::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);
        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function quickMembership(Request $request)
    {
        if($request->get('user_type') && $request->has('reg_no')){
            switch ($request->get('user_type')){
                case 1:
                    $data = Student::where('reg_no','=',$request->reg_no)->first();
                    break;
                case 2:
                    $data = Staff::where('reg_no','=',$request->reg_no)->first();
                    break;
                default:
                    return parent::invalidRequest();
            }
        }

        if($data){
            $currentMember = LibraryMember::where(['user_type' => $request->user_type, 'member_id' => $data->id])->orderBy('id','desc')->first();
            if(!$currentMember){
                $request->request->add(['member_id' => $data->id]);
                $request->request->add(['created_by' => auth()->user()->id]);
                $member = LibraryMember::create($request->all());

                $memberId = $member->member_id;
                $userType = $member->user_type;
                $this->sendLibraryRegistrationAlert($memberId,$userType);

                $request->session()->flash($this->message_success, 'Library Member Created Successfully.');
            }else{
                $request->session()->flash($this->message_warning,'Member already registered. Please find and edit.');
                return back();
            }
        }else{
            $request->session()->flash($this->message_warning,'Registration Number or User Type is not Valid.');
        }

        return back();

    }


}