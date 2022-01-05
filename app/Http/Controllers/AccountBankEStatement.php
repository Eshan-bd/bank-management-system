<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\Account;
use App\Models\BankUser;

use PDF;

class AccountBankEStatement extends Controller
{
    public function downloadEStatement(Request $rqst)
    {
        $validate=$rqst->validate(
            [
                'from'=>'required',
                'to'=>'required',
            ]
        );
    	$account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $history=History::where('account_id', $account->id)->whereBetween('historydate',[$rqst->from, $rqst->to])->orderby('created_at','desc')->get();
    	$credit = History::where('account_id', $account->id)->whereBetween('historydate',[$rqst->from, $rqst->to])->sum('credit');
	    $debit = History::where('account_id', $account->id)->whereBetween('historydate',[$rqst->from, $rqst->to])->sum('debit');
        $currBal=$credit-$debit;
    	$pdf = PDF::loadview('customer.estatementformat', ['account'=> $account, 'history'=> $history, 'user'=>$user, 'currentbal'=>$currBal, 'debit'=>$debit, 'credit'=>$credit, 'from'=> $rqst->from, 'to'=> $rqst->to])
                                                    ->setOptions(['defaultFont' => 'sans-serif'])
                                                    ->setPaper('a4','portrait');
    	return $pdf->download('E-Statement.pdf');
    }
}
