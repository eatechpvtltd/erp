<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\McqExam\Exam;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Mcq\Exam\Instruction\AddValidation;
use App\Http\Requests\Mcq\Exam\Instruction\EditValidation;
use App\Models\McqInstruction;
use App\Models\McqQuestionGroup;
use App\Models\McqQuestionLevel;
use App\Models\StudentStatus;
use Illuminate\Http\Request;

class ExamInstructionController extends CollegeBaseController
{
    protected $base_route = 'mcq.exam.exam-instruction';
    protected $view_path = 'mcq.exam.instruction';
    protected $panel = 'Exam Instruction';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['exam_instructions'] = McqInstruction::get();
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
       $request->request->add(['created_by' => auth()->user()->id]);

       McqInstruction::create($request->all());

       $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
       return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = McqInstruction::find($id))
            return parent::invalidRequest();

        $data['exam_instructions'] = McqInstruction::select('id', 'title', 'status')->orderBy('title')->get();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {

       if (!$row = McqInstruction::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = McqInstruction::find($id)) return parent::invalidRequest();

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
                            $row = McqInstruction::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = McqInstruction::find($row_id);
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
        if (!$row = McqInstruction::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = McqInstruction::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }
}