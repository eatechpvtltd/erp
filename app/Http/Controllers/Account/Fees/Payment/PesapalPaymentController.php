<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Rupani-1 (Province 2, Saptari), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Fees\Payment;
use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeCollection;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Knox\Pesapal\Facades\Pesapal;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Payment;

class PesapalPaymentController extends CollegeBaseController
{

    protected $base_route = 'account.fees';
    protected $view_path = 'account.fees';
    protected $panel = 'Pesapal';

    public function pesapalForm(Request $request)
    {
        //dd('ok');
        $data=[];
        $student = Student::select('students.id','students.reg_no','students.email','students.first_name','students.last_name','ai.mobile_1')
            ->where('students.id',$request->student_id)
            ->join('addressinfos as ai','ai.students_id','=','students.id')
            ->first();

        if($student) {
            $reg = $student->reg_no;
            $amount = $request->net_balance;
            $fee_masters_id = $request->fee_masters_id;
            $description = [
                'STUD_ID'        => $request->student_id,
                'REG_NO'        => $reg,
                'FEE_MASTER_ID' => $request->fee_masters_id,
                'DESCRIPTION'   => $request->description
            ];
            $description = json_encode($description);

            $reference = $reg.'-'.$request->fee_masters_id;

            $data = [
                'student_id' => $request->student_id,
                'fee_masters_id' => $fee_masters_id,
                'reference' => $reference,
                'amount' => $amount,
                'email' => $student->email,
                'firstname' => $student->first_name,
                'lastname' => $student->last_name,
                'phone' => $student->mobile_1,
                'description' => $description,
            ];
        }

        return view(parent::loadDataToView('account.fees.payment.pesapal.form'), compact('data'));
    }

   /*new*/
    public function payment(Request $request){//initiates payment
//        $payments = new Payment;
//        $payments -> businessid = Auth::guard('business')->id(); //Business ID
//        $payments -> transactionid = Pesapal::random_reference();
//        $payments -> status = 'NEW'; //if user gets to iframe then exits, i prefer to have that as a new/lost transaction, not pending
//        $payments -> $request->amount;
//        $payments -> save();

        //get form details
//        $amount = $request->amount;
//        $amount = number_format($amount, 2);//format amount to 2 decimal places
//
//        $desc = $request->description;
//        $type = $request->type; //default value = MERCHANT
//        $reference = $request->reference;//unique order id of the transaction, generated by merchant
//        $first_name = $request->firstname;
//        $last_name = $request->lastname;
//        $email = $request->email;
//        $phonenumber = $request->phone;//ONE of email or phonenumber is required

        $details = array(
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->type ? $request->type:'MERCHANT',
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'phonenumber' => $request->phone,
            'reference' => $request->reference,
            'height'=>'400px',
            'currency' => 'USD'
        );
        //dd($details);
        $data = Pesapal::makePayment($details);
        //dd($data);

        return view('account.fees.payment.pesapal.iframe', compact('data'));
    }

    public function paymentsuccess(Request $request)//just tells u payment has gone thru..but not confirmed
    {
        dd('we are on payment success');
        $trackingid = $request->input('tracking_id');
        $ref = $request->input('merchant_reference');

        $payments = Payment::where('transactionid',$ref)->first();
        $payments -> trackingid = $trackingid;
        $payments -> status = 'PENDING';
        $payments -> save();
        //go back home
        $payments=Payment::all();
        return view('payments.business.home', compact('payments'));
    }
    //This method just tells u that there is a change in pesapal for your transaction..
    //u need to now query status..retrieve the change...CANCELLED? CONFIRMED?
    public function paymentconfirmation(Request $request)
    {
        $trackingid = $request->input('pesapal_transaction_tracking_id');
        $merchant_reference = $request->input('pesapal_merchant_reference');
        $pesapal_notification_type= $request->input('pesapal_notification_type');

        //use the above to retrieve payment status now..
        $this->checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type);
    }
    //Confirm status of transaction and update the DB
    public function checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type){
        $status=Pesapal::getMerchantStatus($merchant_reference);
        $payments = Payment::where('trackingid',$trackingid)->first();
        $payments -> status = $status;
        $payments -> payment_method = "PESAPAL";//use the actual method though...
        $payments -> save();
        return "success";
    }




}