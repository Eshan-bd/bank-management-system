<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\BankUser;
use App\Models\Beneficiary;
use App\Models\History;

class AccountBeneficiaryController extends Controller
{
    public function addbeneficiary()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        return view('customer.addbeneficiary')->with('account',$account)
                                              ->with('user', $user);
    }

    public function addbeneficiarySubmit(Request $rqst)
    {
        $validate=$rqst->validate(
            [
                'beneficiaryname' => 'required|min:5|alpha_dash',
                'beneficiaryaccountname' => 'required|exists:accounts,accountname',
            ],
            [
                'beneficiaryname.required'=>'Beneficiary name is required',
                'beneficiaryname.alpha_dash'=>'Beneficiary name should  contain letters and numbers with dashes',
                'beneficiaryaccountname.required'=>'Account name is required',
                'beneficiaryaccountname.exists'=>'Account name does not exists',
            ]
        );
        $account=Account::where('id', session()->get('accountid'))->first();
        $accountb=Account::where('accountname', $rqst->beneficiaryaccountname)->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        if($accountb->accountstate=='ACTIVE')
        {
            $var = new Beneficiary();
            $var->beneficiaryname=$rqst->beneficiaryname;
            $var->beneficiaryaccountid=$accountb->id;
            $var->accountid=$account->id;
            $var->save();
            return redirect()->route('account.beneficiarylist');
        }
        else {
            return redirect()->back()->with('addbeneficiaryerror', 'The Account is not activated');
        }
    }

    public function beneficiarylist()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $beneficiaries = DB::table('accounts')
	                        ->join('beneficiaries', 'accounts.id', '=', 'beneficiaries.beneficiaryaccountid')
                            ->select('accounts.accountname', 'beneficiaries.*')
                            ->where('beneficiaries.accountid', $account->id)
                            ->get();
        return view('customer.beneficiarylist')->with('account',$account)
                                               ->with('user', $user)
                                               ->with('beneficiaries', $beneficiaries);
    }

    public function send(Request $rqst)
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $beneficiary=Beneficiary::where('id', $rqst->id)->first();
        $accountb=Account::where('id', $beneficiary->beneficiaryaccountid)->first();
        return view('customer.send')->with('account',$account)
                                    ->with('user', $user)
                                    ->with('beneficiary', $beneficiary)
                                    ->with('benaccount', $accountb);
    }

    public function sendSubmit(Request $rqst)
    {
        $validate=$rqst->validate(
            [
                'amount'=>'required|numeric',
                'password'=>'required|string',
            ]
        );
        $account=Account::where('id', session()->get('accountid'))->first();
        $accountb=Account::where('accountname', $rqst->id)->first();
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
                        return redirect()->route('account.history');
                    }
                    else {
                        return redirect()->back()->with('senderror', 'Amount cannot exceed your account balance');
                    }
                }
                else {
                    return redirect()->back()->with('senderror', 'Wrong Password! Please Try Again...');
                }
            }
            else {
                return redirect()->back()->with('senderror', 'Selected account is not active right now! Please try again later.');
            }
        }
    }

    public function payment()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        return view('customer.payment')->with('account',$account)
                                       ->with('user', $user);
    }

    public function paymentSubmit(Request $rqst)
    {
        $validate=$rqst->validate(
            [
                'paymentcode'=>'required|alpha_num|max:10',
                'amount'=>'required|numeric',
                'password'=>'required|string',
            ]
        );
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
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
                return redirect()->route('account.history');
            }
            else {
                return redirect()->back()->with('payerror', 'Amount cannot exceed your account balance');
            }
        }
        else {
            return redirect()->back()->with('payerror', 'Wrong Password! Please Try Again...');
        }
    }

    public function statement()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $history=History::where('account_id', $account->id)->orderby('created_at','desc')->get();
        $debit=2;
        $credit=5;
        return view('customer.estatementform')->with('account',$account)
                                                 ->with('user', $user)
                                                 ->with('history', $history)
                                                 ->with('debit', $debit)
                                                 ->with('credit', $credit);
    }

    public function deletebeneficiary(Request $rqst)
    {
        $beneficiary=Beneficiary::where('id', $rqst->id)->first();
        $beneficiary->delete();
        return redirect()->route('account.beneficiarylist');
    }
}
