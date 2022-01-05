<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;
use App\Models\BankUser;
use App\Models\History;
use App\Models\Beneficiary;

class AccountOperationController extends Controller
{
    public function dashboard()
    {
        $customer=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $customer->bank_user_id)->first();
        $history=History::where('account_id', $customer->id)->orderby('created_at','desc')->first();
        $time = strtotime($history->created_at);
        $sanitized_time = date("d/m/Y, g:i A", $time);
        $beneficiarycount=Beneficiary::where('accountid', $customer->id)->count();
        return view('customer.dashboard')->with('account', $customer)
                                         ->with('user', $user)
                                         ->with('count', $beneficiarycount)
                                         ->with('date', $sanitized_time)
                                         ->with('history', $history);
    }

    public function history()
    {
        $customer=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $customer->bank_user_id)->first();
        $history=History::where('account_id', $customer->id)->orderby('created_at','desc')->get();
        return view('customer.history')->with('history',$history)
                                       ->with('user', $user);
    }

    public function historysort(Request $req)
    {
        $customer=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $customer->bank_user_id)->first();
        if($req->name=='historydate')
        {
            $history1=History::where('account_id', $customer->id)->orderby('created_at','desc')->get();
            return view('customer.history')->with('history',$history1)->with('user', $user);;
        }
        elseif($req->name=='remarks')
        {
            $history2=History::where('account_id', $customer->id)->orderby('remarks','desc')->get();
            return view('customer.history')->with('history',$history2)->with('user', $user);;
        }
        elseif($req->name=='debit')
        {
            $history3=History::where('account_id', $customer->id)->orderby('debit','desc')->get();
            return view('customer.history')->with('history',$history3)->with('user', $user);;
        }
        elseif($req->name=='credit')
        {
            $history4=History::where('account_id', $customer->id)->orderby('credit','desc')->get();
            return view('customer.history')->with('history',$history4)->with('user', $user);;
        }
        else {
            return redirect()->route('account.history');
        }
    }

    public function profile()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        $time = strtotime($account->created_at);
        $sanitized_time = date("d/m/Y, g:i A", $time);
        return view('customer.profile')->with('account', $account)
                                       ->with('created', $sanitized_time)
                                       ->with('user', $user);
    }

    public function edit()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        return view('customer.edit')->with('account', $account)
                                    ->with('user', $user);
    }

    public function editSubmit(Request $rqst)
    {
        $account=Account::where('id', $rqst->session()->get('accountid'))->first();
        $validate=$rqst->validate(
            [
                'profilepicture'=>'image|nullable|max:1999',
                'phone'=>'required|min:11|max:14|string',
                'email'=>'required|email',
                'accountname'=>'required|min:5|unique:accounts,accountname,'.$account->id.'|unique:employees,empname|unique:admins,adminname|string',
            ]
            );
        if($rqst->accountname!=$account->accountname)
        {
            $account->accountname=$rqst->accountname;
            $account->save();
        }
        $bankuser=BankUser::where('id', $account->bank_user_id)->first();
        $bankuser->phone=$rqst->phone;
        $bankuser->email=$rqst->email;
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
        }
        $bankuser->save();
        return redirect()->route('account.profile');
    }

    public function changepassword()
    {
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        return view('customer.changepassword')->with('account', $account)
                                              ->with('user', $user);
    }

    public function changepasswordSubmit(Request $rqst)
    {
        $validate=$rqst->validate(
            [
                'oldpassword' =>'required|min:8|string',
                'password'=>'required|min:8|string|confirmed',
            ]
        );
        $account=Account::where('id', session()->get('accountid'))->first();
        $user=BankUser::where('id', $account->bank_user_id)->first();
        if(md5($rqst->oldpassword)==$account->password)
        {
            $account->password=md5($rqst->password);
            $account->save();
            return redirect()->route('account.profile');
        }
        else {
            return back()->with('registererror', '*You already have an account!')
                         ->with('account', $account)
                         ->with('user', $user);
        }
        return view('customer.changepassword')->with('account', $account)
                                              ->with('user', $user);
    }
}
