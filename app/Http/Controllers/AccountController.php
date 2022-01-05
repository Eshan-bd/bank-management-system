<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\MOdels\BankUser;
use App\MOdels\History;

class AccountController extends Controller
{
    public function registration()
    {
        return view('customer.registration');
    }

    public function register(Request $rqst)
    {
        $validate=$rqst->validate(
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
            ],
            [
                'profilepicture.image'=>'Profile Picture must be an image.',
                'profilepicture.max'=>'Profile Picture must be within 2MB.',
                'niddoc.required'=>'NID picture must be uploaded.',
                'niddoc.image'=>'NID picture must be an image.',
                'niddoc.max'=>'NID picture must be within 2MB.',
                'privacy.required'=>'***You should be agreed with the Policy Statement and check the above box!'
            ]
        );

        //handle profile picture upload
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
            return back()->with('registererror', '*You already have an account!');
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
            return redirect()->route('home.login')->with('loginerror', 'Your Request is processing. Please check back again after a while!');
        }
    }
}
