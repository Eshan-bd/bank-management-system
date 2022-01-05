<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\BankUser;
use App\Models\LoanType;
use App\Models\LoanRequest;

class AccountLoanController extends Controller
{
    public function loanrequest()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $loantypes=LoanType::all();
        return view('customer.loanrequest')->with('account', $account)
                                           ->with('user', $user)
                                           ->with('loantypes', $loantypes);
    }

    public function loanrequestSubmit(Request $rqst)
    {
        $validate=$rqst->validate(
            [
                'loantype'=>'required',
                'amount'=>'required|numeric',
                'loandoc'=>'required|image|max:1999',
                'password'=>'required|string',
            ]
        );
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
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
            return redirect()->route('account.loanstate');
        }
        else {
            return redirect()->back()->with('loanerror', 'Wrong Password! Please Try Again...');
        }
    }

    public function loanstatus()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $loanrequests=LoanRequest::where('account_id', $account->id)->orderby('created_at','desc')->get();
        return view('customer.loanstatus')->with('account', $account)
                                          ->with('user', $user)
                                          ->with('loanrequests', $loanrequests);
    }

    public function deleterequest(Request $rqst)
    {
        $loanreq=LoanRequest::where('id', $rqst->id);
        $loanreq->delete();
        return redirect()->route('account.loanstate');
    }
}
