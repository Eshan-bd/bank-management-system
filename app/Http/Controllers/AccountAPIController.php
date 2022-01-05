<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\BankUser;
use App\Models\History;
use App\Models\Beneficiary;
use App\Models\UserToken;
use App\Models\LoanRequest;
use DateTime;
use PDF;

class AccountAPIController extends Controller
{
    public function register(Request $rqst)
    {
        $message = [
            'profilepicture.image'=>'Profile Picture must be an image.',
            'profilepicture.max'=>'Profile Picture must be within 2MB.',
            'niddoc.required'=>'NID picture must be uploaded.',
            'niddoc.image'=>'NID picture must be an image.',
            'niddoc.max'=>'NID picture must be within 2MB.',
            'privacy.required'=>'***You should be agreed with the Policy Statement and check the above box!'
        ];
        $validation = Validator::make($rqst->all(),
        [
            'profilepicture'=>'image|nullable|max:1999',
            'firstname'=>'required|min:3|string',
            'lastname'=>'required|min:3|string',
            'gender'=>'required',
            'dateofbirth'=>'required|date',
            'phone'=>'required|min:11|max:14|string',
            'email'=>'required|email',
            'nid'=>'required|max:15',
            'niddoc'=>'required|image|max:1999',
            'accountname'=>'required|min:5|unique:accounts,accountname|unique:employees,empname|unique:admins,adminname|string',
            'accounttype'=>'required',
            'password'=>'required|min:8|string|confirmed',
            'privacy'=>'required',
        ], $message);

        //handle profile picture upload
        if($validation->fails()){
            return response()->json([
                'reg_validation_error' => $validation->messages(),
            ]);
        }
        else {
            if($rqst->hasFile('profilepicture'))
            {
                $profilePicWithExt = $rqst->file('profilepicture')->getClientOriginalName();
                $profilePicName = pathinfo($profilePicWithExt, PATHINFO_FILENAME);
                $profilePicExt = $rqst->file('profilepicture')->getClientOriginalExtension();
                $profilePicToUpload = $profilePicName.'_'.time().'.'.$profilePicExt;
                $profilePath = $rqst->file('profilepicture')->storeAs('public/account/profilepictures', $profilePicToUpload);
            }
            else {
                $profilePicToUpload = 'noprofileimage.png';
            }

            //handle nid document upload
            if($rqst->hasFile('niddoc'))
            {
                $nidPicWithExt = $rqst->file('niddoc')->getClientOriginalName();
                $nidPicName = pathinfo($nidPicWithExt, PATHINFO_FILENAME);
                $nidPicExt = $rqst->file('niddoc')->getClientOriginalExtension();
                $nidPicToUpload = $nidPicName.'_'.time().'.'.$nidPicExt;
                $nidPath = $rqst->file('niddoc')->storeAs('public/account/accountdocuments', $nidPicToUpload);
            }

            $checkuser=BankUser::where('nid', $rqst->nid)->first();

            if($checkuser)
            {
                return response()->json([
                    'regerror' => '*You already have an account!',
                ]);
            }

            else
            {
                $var= new BankUser();
                $var->firstname=$rqst->firstname;
                $var->lastname=$rqst->lastname;
                $var->gender=$rqst->gender;
                $var->dateofbirth=$rqst->dateofbirth;
                $var->phone=$rqst->phone;
                $var->email=$rqst->email;
                $var->userprofilepicture=$profilePicToUpload;
                $var->nid=$rqst->nid;
                $var->save();

                $bankuserid = BankUser::where('nid', $rqst->nid)->first();

                if($bankuserid)
                {
                    $varacc = new Account();
                    $varacc->accountname=$rqst->accountname;
                    $varacc->accounttype=$rqst->accounttype;
                    $varacc->password=md5($rqst->password);
                    $varacc->accountbalance=5000.00;
                    if($rqst->accounttype=="Savings Account")
                    {
                        $varacc->accountinterestrate=7.50;
                    }
                    elseif($rqst->accounttype=="Business Account")
                    {
                        $varacc->accountinterestrate=5.00;
                    }
                    elseif($rqst->accounttype=="Student Account")
                    {
                        $varacc->accountinterestrate=10.50;
                    }
                    if($rqst->hasFile('niddoc'))
                    {
                        $varacc->accountdocument=$nidPicToUpload;
                    }
                    $varacc->accountstate="INACTIVE";
                    $varacc->bank_user_id=$bankuserid->id;
                    $varacc->save();

                    $accountid = Account::where('accountname', $rqst->accountname)->first();

                    if($accountid)
                    {
                        $varhistory = new History();
                        $varhistory->historydate=date("Y-m-d");
                        $varhistory->remarks="Opening Balance";
                        $varhistory->debit=0.00;
                        $varhistory->credit=5000.00;
                        $varhistory->account_id=$accountid->id;
                        $varhistory->save();
                    }
                }
                return response()->json([
                    'regsuccess' => 'Your Request is processing. Please check back again after a while!',
                ]);
            }
        }
    }

    public function editSubmit(Request $rqst)
    {
        $account=Account::where('id', $rqst->id)->first();
        $validation = Validator::make($rqst->all(),
        [
            'profilepicture'=>'image|nullable|max:1999',
            'phone'=>'required|min:11|max:14|string',
            'email'=>'required|email',
            'accountname'=>'required|min:5|unique:accounts,accountname,'.$account->id.'|unique:employees,empname|unique:admins,adminname|string',
        ]);
        if($validation->fails()){
            return response()->json([
                'edit_validation_error' => $validation->messages(),
            ]);
        }
        else {
            if($rqst->accountname!=$account->accountname)
            {
                $account->accountname=$rqst->accountname;
                $account->save();
            }
            $picpath = 'Success';
            $bankuser=BankUser::where('id', $account->bank_user_id)->first();
            if($bankuser->phone!=$rqst->phone){ $bankuser->phone=$rqst->phone; }
            if($bankuser->email!=$rqst->email){ $bankuser->email=$rqst->email; }
            if($rqst->hasFile('profilepicture'))
            {
                $profilePicWithExt = $rqst->file('profilepicture')->getClientOriginalName();
                $profilePicName = pathinfo($profilePicWithExt, PATHINFO_FILENAME);
                $profilePicExt = $rqst->file('profilepicture')->getClientOriginalExtension();
                $profilePicToUpload = $profilePicName.'_'.time().'.'.$profilePicExt;
                $profilePath = $rqst->file('profilepicture')->storeAs('public/account/profilepictures', $profilePicToUpload);
                
                if($bankuser->userprofilepicture!="noprofileimage.png")
                {
                    //Delete from storage
                    Storage::delete('public/account/profilepictures/'.$bankuser->userprofilepicture);
                }
                $bankuser->userprofilepicture=$profilePicToUpload;
                $picpath = $profilePicToUpload;
            }
            $bankuser->save();
            return response()->json([
                'editsuccess' => $picpath,
            ]);
        }
    }

    public function changepasswordSubmit(Request $rqst)
    {
        $validation = Validator::make($rqst->all(),
        [
            'oldpassword' =>'required|min:8|string',
            'password'=>'required|min:8|string|confirmed',
        ]);

        if($validation->fails()){
            return response()->json([
                'pass_validation_error' => $validation->messages(),
            ]);
        }
        else {
            $account=Account::where('id', $rqst->id)->first();
            $user=BankUser::where('id', $account->bank_user_id)->first();
            if(md5($rqst->oldpassword)==$account->password)
            {
                $account->password=md5($rqst->password);
                $account->save();
                return response()->json([
                    'passsuccess' => "Successfull",
                ]);
            }
            else {
                return response()->json([
                    'pass_error' => "Enter the old password correctly!",
                ]);
            }
        }
    }

    public function dashboard(Request $rqst)
    {
        $customer=Account::where('id', $rqst->id)->first();
        $user=BankUser::where('id', $customer->bank_user_id)->first();
        $history=History::where('account_id', $customer->id)->orderby('created_at','desc')->first();
        $time = strtotime($history->created_at);
        $sanitized_time = date("d/m/Y, g:i A", $time);
        $beneficiarycount=Beneficiary::where('accountid', $customer->id)->count();
        return response()->json([
            'name' => $user->firstname." ".$user->lastname,
            'balance' => $customer->accountbalance,
            'bencount' => $beneficiarycount,
            'date' => $sanitized_time,
            'history' => $history,
        ]);
    }

    public function profile(Request $rqst)
    {
        $account=Account::where('id', $rqst->id)->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $time = strtotime($account->created_at);
        $sanitized_time = date("d/m/Y, g:i A", $time);
        return response()->json([
            'accountdetails' => $account,
            'created' => $sanitized_time,
            'user' => $user,
        ]);
    }

    public function history(Request $rqst)
    {
        $history=History::where('account_id', $rqst->id)->orderby('created_at','desc')->get();
        return response()->json([
            'history' => $history,
        ]);
    }

    public function addbeneficiarySubmit(Request $rqst)
    {
        $message = [
            'beneficiaryname.required'=>'Beneficiary name is required',
            'beneficiaryname.alpha_dash'=>'Beneficiary name should  contain letters and numbers with dashes',
            'beneficiaryaccountname.required'=>'Account name is required',
            'beneficiaryaccountname.exists'=>'Account name does not exists',
        ];

        $validation = Validator::make($rqst->all(),
        [
            'beneficiaryname' => 'required|min:5|alpha_dash',
            'beneficiaryaccountname' => 'required|exists:accounts,accountname',
        ], $message);

        if($validation->fails()){
            return response()->json([
                'ben_validation_error' => $validation->messages(),
            ]);
        }
        else {
            $account=Account::where('id', $rqst->id)->first();
            $accountb=Account::where('accountname', $rqst->beneficiaryaccountname)->first();
            $user=BankUser::where('id', $account->bank_user_id)->first();
            if($accountb->accountstate=='ACTIVE')
            {
                $var = new Beneficiary();
                $var->beneficiaryname=$rqst->beneficiaryname;
                $var->beneficiaryaccountid=$accountb->id;
                $var->accountid=$account->id;
                $var->save();
                return response()->json([
                    'bensuccess' => "Successful",
                ]);
            }
            else {
                return response()->json([
                    'ben_error' => 'The Given Account is not active!',
                ]);
            }
        }
    }

    public function beneficiarylist(Request $rqst)
    {
        $account=Account::where('id', $rqst->id)->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $beneficiaries = DB::table('accounts')
	                        ->join('beneficiaries', 'accounts.id', '=', 'beneficiaries.beneficiaryaccountid')
                            ->select('accounts.accountname', 'beneficiaries.*')
                            ->where('beneficiaries.accountid', $account->id)
                            ->get();
        return response()->json([
            'benlist' => $beneficiaries,
        ]);
    }

    public function sendSubmit(Request $rqst)
    {
        $validation = Validator::make($rqst->all(),
        [
            'amount'=>'required|numeric',
            'password'=>'required|string',
        ]);
        if($validation->fails()){
            return response()->json([
                'sm_validation_error' => $validation->messages(),
            ]);
        }
        else {
            $account=Account::where('id', $rqst->id)->first();
            $accountb=Account::where('accountname', $rqst->bid)->first();
            if($accountb)
            {
                if($accountb->accountstate=="ACTIVE")
                {
                    if(md5($rqst->password)==$account->password)
                    {
                        if($rqst->amount<=$account->accountbalance)
                        {
                            $account->accountbalance=$account->accountbalance-doubleval($rqst->amount);
                            $accountb->accountbalance=$accountb->accountbalance+doubleval($rqst->amount);
                            $history=new History();
                            $historyb=new History();
                            $history->historydate=date("Y-m-d");
                            $historyb->historydate=date("Y-m-d");
                            $history->remarks="Fund Transfered to ".$accountb->accountname;
                            $historyb->remarks="Fund Received From ".$account->accountname;
                            $history->debit=$rqst->amount;
                            $historyb->debit=0.00;
                            $history->credit=0.00;
                            $historyb->credit=$rqst->amount;
                            $history->account_id=$account->id;
                            $historyb->account_id=$accountb->id;
                            $account->save();
                            $accountb->save();
                            $history->save();
                            $historyb->save();
                            return response()->json([
                                'smsuccess' => 'successful',
                            ]);
                        }
                        else {
                            return response()->json([
                                'sm_error' => 'Amount cannot exceed your account balance',
                            ]);
                        }
                    }
                    else {
                        return response()->json([
                            'sm_error' => 'Wrong Password! Please Try Again...',
                        ]);
                    }
                }
                else {
                    return response()->json([
                        'sm_error' => 'Selected account is not active right now! Please try again later.',
                    ]);
                }
            }
        }
    }

    public function paymentSubmit(Request $rqst)
    {
        $validation = Validator::make($rqst->all(),
        [
            'paymentcode'=>'required|alpha_num|max:10',
            'amount'=>'required|numeric',
            'password'=>'required|string',
        ]);
        if($validation->fails()){
            return response()->json([
                'pay_validation_error' => $validation->messages(),
            ]);
        }
        else {
            $account=Account::where('id', $rqst->id)->first();
            //$user=BankUser::where('id', $account->bank_user_id)->first();
            if(md5($rqst->password)==$account->password)
            {
                if($rqst->amount<=$account->accountbalance)
                {
                    $history=new History();
                    $history->historydate=date('Y-m-d');
                    if($rqst->remarks!="")
                    {
                        $history->remarks="Payment Code: ".$rqst->paymentcode." Remarks: '".$rqst->remarks."'";
                    }
                    else {
                        $history->remarks="Payment Code: ".$rqst->paymentcode;
                    }
                    $history->debit=$rqst->amount;
                    $history->credit=0.00;
                    $history->account_id=$account->id;
                    $account->accountbalance=$account->accountbalance-$rqst->amount;
                    $history->save();
                    $account->save();
                    return response()->json([
                        'paysuccess' => 'successful',
                    ]);
                }
                else {
                    return response()->json([
                        'payerror' => 'Amount cannot exceed your account balance',
                    ]);
                }
            }
            else {
                return response()->json([
                    'payerror' => 'Wrong Password! Please Try Again...',
                ]);
            }
        }
    }

    public function loanrequestSubmit(Request $rqst)
    {
        $validation = Validator::make($rqst->all(),
        [
            'loantype'=>'required',
            'amount'=>'required|numeric',
            'loandoc'=>'required|image|max:1999',
            'password'=>'required|string',
        ]);
        if($validation->fails()){
            return response()->json([
                'lreq_validation_error' => $validation->messages(),
            ]);
        }
        else {
            $account=Account::where('id', $rqst->id)->first();
            //$user=BankUser::where('id', $account->bank_user_id)->first();
            if(md5($rqst->password)==$account->password)
            {
                $var=new LoanRequest();
                $var->loantype=$rqst->loantype;
                $var->loanamount=$rqst->amount;
                if($rqst->hasFile('loandoc'))
                {
                    $loanPicWithExt = $rqst->file('loandoc')->getClientOriginalName();
                    $loanPicName = pathinfo($loanPicWithExt, PATHINFO_FILENAME);
                    $loanPicExt = $rqst->file('loandoc')->getClientOriginalExtension();
                    $loanPicToUpload = $loanPicName.'_'.time().'.'.$loanPicExt;
                    $loanPath = $rqst->file('loandoc')->storeAs('public/account/accountdocuments', $loanPicToUpload);
                    $var->loandocument=$loanPicToUpload;
                }
                $var->loanrequeststatus="PENDING";
                $var->account_id=$account->id;
                $var->save();
                return response()->json([
                    'lreqSuccess' => 'Successful',
                ]);
            }
            else {
                return response()->json([
                    'lreq_error' => 'Wrong Password! Please Try Again...',
                ]);
            }
        }
    }

    public function loanstatus(Request $rqst)
    {
        $account=Account::where('id', $rqst->id)->first();
        //$user=BankUser::where('id', $account->bank_user_id)->first();
        $loanrequests=LoanRequest::where('account_id', $account->id)->orderby('created_at','desc')->get();
        return response()->json([
            'loanreqs' => $loanrequests,
        ]);
    }

    public function deleterequest(Request $rqst)
    {
        $loanreq=LoanRequest::where('id', $rqst->id);
        $loanreq->delete();
        return response()->json([
            'dlsuccess' => "Successfull",
        ]);
    }

    public function deletebeneficiary(Request $rqst)
    {
        $beneficiary=Beneficiary::where('id', $rqst->id)->first();
        $beneficiary->delete();
        return response()->json([
            'delSuccess' => "Successfull",
        ]);
    }

    public function logout(Request $rqst)
    {
        $token = UserToken::Where('userkey', $rqst->key)->first();
        $token->expired_at = new DateTime();
        $token->save();
        return http_response_code(200);
    }

    public function downloadEStatement(Request $rqst)
    {
        // $validation = Validator::make($rqst->all(),
        // [
        //     'from'=>'required',
        //     'to'=>'required',
        // ]);
        // if($validation->fails()){
        //     return response()->json([
        //         'pdf_validation_error' => $validation->messages(),
        //     ]);
        // }
    	// else {
            $account=Account::where('id', $rqst->id)->first();
            $user=BankUser::where('id', $account->bank_user_id)->first();
            $history=History::where('account_id', $account->id)->whereBetween('historydate',[$rqst->from, $rqst->to])->orderby('created_at','desc')->get();
            $credit = History::where('account_id', $account->id)->whereBetween('historydate',[$rqst->from, $rqst->to])->sum('credit');
            $debit = History::where('account_id', $account->id)->whereBetween('historydate',[$rqst->from, $rqst->to])->sum('debit');
            $currBal=$credit-$debit;
            // $pdf = PDF::loadview('customer.estatementformat', ['account'=> $account, 'history'=> $history, 'user'=>$user, 'currentbal'=>$currBal, 'debit'=>$debit, 'credit'=>$credit, 'from'=> $rqst->from, 'to'=> $rqst->to])
            //                                             ->setOptions(['defaultFont' => 'sans-serif'])
            //                                             ->setPaper('a4','portrait');
            // return $pdf->download('E-Statement.pdf'); 
            return response()->json(['account'=> $account, 'history'=> $history, 'user'=>$user, 'currentbal'=>$currBal, 'tdebit'=>$debit, 'tcredit'=>$credit,]);
            // return response()->json([
            //     'pdffile' => htmlentities($pdf),
            // ]);
        //}
    }
}
