<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Academic;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Academic\Grading\AddValidation;
use App\Http\Requests\Academic\Grading\EditValidation;
use App\Models\GradingScale;
use App\Models\GradingType;
use Illuminate\Http\Request;
class GradingController extends CollegeBaseController
{
    protected $base_route = 'grading';
    protected $view_path = 'academic.academic-hub.grading';
    protected $panel;
    protected $filter_query = [];

    public function __construct()
    {
        $this->panel = __('academic.child.grading_subject.child.grading');
    }

    public function index()
    {
       $data = [];
       $data['grading'] = GradingType::select('id', 'title', 'status')
            ->orderBy('title')
            ->get();

       return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['slug' => $request->get('title')]);

        $gradingType = GradingType::create($request->all());

        if($request->get('name')){
            foreach ($request->get('name') as $key => $row_id){
                $gradingScale = [
                    'gradingType_id' => $gradingType->id,
                    'name' => $row_id,
                    'percentage_from' => $request->get('percentage_from')[$key],
                    'percentage_to' => $request->get('percentage_to')[$key],
                    'grade_point' => $request->get('grade_point')[$key],
                    'description' => $request->get('description')[$key],
                    'created_by' => auth()->user()->id
                ];
                GradingScale::create($gradingScale);
            }
        }

        $request->session()->flash($this->message_success, $this->panel. 'Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = [];
        if (!$data['row'] = GradingType::find($id))
            return parent::invalidRequest();

        $data['grading'] = GradingType::select('id', 'title', 'status')
            ->orderBy('title')
            ->get();

        $data['grade_scale'] = $data['row']->gradingScale('id','name', 'percentage_from','percentage_to','grade_point','description')->get();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {
        $id = decrypt($id);
        if (!$row = GradingType::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);
        //update & add grade scales
        foreach ($request->get('gsID') as $key => $grade) {
            if ($grade == null) {
                //create
                $gradingScale = [
                    'gradingType_id' => $row->id,
                    'name' => $request->get('name')[$key],
                    'percentage_from' => $request->get('percentage_from')[$key],
                    'percentage_to' => $request->get('percentage_to')[$key],
                    'grade_point' => $request->get('grade_point')[$key],
                    'description' => $request->get('description')[$key],
                    'created_by' => auth()->user()->id
                ];
                GradingScale::create($gradingScale);

            }else {
                //update
                $grade_scale = GradingScale::find($grade);
                $grade_scale->update([
                    'gradingType_id' => $row->id,
                    'name' => $request->get('name')[$key],
                    'percentage_from' => $request->get('percentage_from')[$key],
                    'percentage_to' => $request->get('percentage_to')[$key],
                    'grade_point' => $request->get('grade_point')[$key],
                    'description' => $request->get('description')[$key],
                    'last_updated_by' => auth()->user()->id
                ]);

            }
        }

        //update grading type
        $row->update($request->all());
        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = GradingType::find($id)) return parent::invalidRequest();

        try {
            //delete grading
            $row->delete();
            //remove associate scale
            $row->gradingScale()->delete();
            $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            $request->session()->flash($this->message_danger, $this->panel.' Not Deleted Yet. The Grading type linked with Semester/Sec. If you want to delete it, Please Unlink from Semester/Sec.');
        }

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
                            $row = GradingType::find(decrypt($row_id));
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $this->delete($request, $row_id);
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $this->panel.' '.ucfirst($request->get('bulk_action')) . ' Successfully.');
                else
                    //$request->session()->flash($this->message_success, $this->panel.' '.ucfirst($request->get('bulk_action')).' successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, check at least one '.$this->panel);
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = GradingType::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        $id = decrypt($id);
        if (!$row = GradingType::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->faculty.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function gradeHtmlRow()
    {
        $response['html'] = view($this->view_path.'.includes.grade_tr')->render();
        return response()->json(json_encode($response));
    }
}
