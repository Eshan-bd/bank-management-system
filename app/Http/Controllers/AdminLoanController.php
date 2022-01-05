<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\LoanRequest;
use App\Models\LoanType;
use App\Models\Account;
use App\Models\History;

class AdminLoanController extends Controller
{
    public function loanRequests(){

    	$loanReq = LoanRequest::all();

    	return view('admin.loanRequest')->with('loanRequest', $loanReq); 
    }

    public function loanRequestsReject(Request $request){

    	$loanDisable = LoanRequest::where('id', $request->id)->first();

    	$loanDisable->loanrequeststatus = 'REJECTED';
    	$loanDisable->save();

    	$loanReq = LoanRequest::all();

    	return view('admin.loanRequest')->with('loanRequest', $loanReq);
    }


    public function loanRequestsAccept(Request $request){

    	$loanAccept = LoanRequest::where('id', $request->id)->first();
    	$loanAccept->loanrequeststatus = "ACCEPTED";
    	$loanAccept->save();

    	$loanType = LoanType::where('type', $loanAccept->loantype)->first();

    	$loan = new Loan();
    	$loan->loantype = $loanType->type;
    	$loan->loanamount = $loanAccept->loanamount;
    	$loan->loaninterestrate = $loanType->rate;
    	$loan->amountpaid = 0;
    	$loan->loanapprovedate = date('Y-m-d H:i:s');
    	$loan->loandocument = $loanAccept->loandocument;
    	$loan->loanstatus = 'ACCEPTED';
    	$loan->account_id = $loanAccept->account_id;
    	$loan->save();

    	$account = Account::where('id', $loan->account_id )->first();
    	$account->accountbalance = $account->accountbalance + $loan->loanamount;
    	$account->save();

    	$history = new History();
    	$history->historydate = date('Y-m-d H:i:s');
    	$history->remarks = $loan->loanamount.' credited for '.$loan->loantype;
    	$history->debit = 0;
    	$history->credit = $loan->loanamount;
    	$history->account_id = $account->id;
    	$history->save();

    	

    	$loanReq = LoanRequest::all();

    	return view('admin.loanRequest')->with('loanRequest', $loanReq);

    }
}
