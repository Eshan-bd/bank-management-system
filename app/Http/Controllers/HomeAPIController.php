<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DateTime;
use DateInterval;
use App\Models\BankUser;
use App\Models\Admin;
use App\Models\Account;
use App\Models\Employee;
use App\Models\News;
use App\Models\LoanType;
use App\Models\UserToken;

class HomeAPIController extends Controller
{
    public function welcome()
    {
        $loan=LoanType::all();
        return $loan;
    }

    public function news()
    {
        $news=News::orderby('created_at','desc')->get();
        return $news;
    }

    public function loginSubmit(Request $rqst)
    {
        $validation = Validator::make($rqst->all(),
        [
            'username'=>'required|string',
            'password'=>'required|string',
        ]);

        if($validation->fails()){
            return response()->json([
                'validation_error' => $validation->messages(),
            ]);
        }
        else {
            $admin = Admin::where('adminname', $rqst->username)
                           ->where('password', md5($rqst->password))
                           ->first();
            $employee = Employee::where('empname', $rqst->username)
                            ->where('password', md5($rqst->password))
                            ->first();
            $customer = Account::where('accountname', $rqst->username)
                            ->where('password', md5($rqst->password))
                            ->first();
            if($admin)
            {
                $crt = new DateTime();
                $end = new DateTime();
                $admintoken = new UserToken();
                $admintoken->bank_user_id = $admin->bank_user_id;
                $admintoken->userkey = Str::random(64);
                $admintoken->created_at = $crt;
                $admintoken->expired_at = $end->add(new DateInterval('P0Y0M0DT1H30M0S'));
                $admintoken->save();
                return response()->json([
                    'admin' => $admintoken,
                    'adminid' => $admin->id,
                    'adminname' => $admin->adminname,
                    'adminbankid' => $admin->bank_user_id,

                ]);
            }
            // elseif($employee)
            // {
            //     $rqst->session()->put('empid', $employee->id);
            //     return redirect()->route('home.news');
            // }
            elseif($customer)
            {
                if($customer->accountstate=="ACTIVE")
                {
                    $crt = new DateTime();
                    $end = new DateTime();
                    $customertoken = new UserToken();
                    $customertoken->bank_user_id = $customer->bank_user_id;
                    $customertoken->userkey = Str::random(64);
                    $customertoken->created_at = $crt;
                    $customertoken->expired_at = $end->add(new DateInterval('P0Y0M0DT0H30M0S'));
                    $customertoken->save();
                    $customerBank = BankUser::where('id', $customer->bank_user_id)->first();
                    $customerName = $customerBank->firstname . " " . $customerBank->lastname;
                    return response()->json([
                        'customer' => $customertoken,
                        'customerid' => $customer->id,
                        'customerbankid' => $customer->bank_user_id,
                        'customername' => $customerName,
                        'customerpic' => $customerBank->userprofilepicture,
                    ]);
                }
                elseif($customer->accountstate=="INACTIVE")
                {
                    return response()->json([
                        'loginerror' => 'Your Request is processing. Please check back again after a while!',
                    ]);
                }
                elseif($customer->accountstate=="DISABLE")
                {
                    return response()->json([
                        'loginerror' => 'Your account has been disabled by admin. Please contact to Account Relationship Manager!',
                    ]);
                }
            }
            else {
                return response()->json([
                    'loginerror' => '*Please Enter Valid Credentials!',
                ]);
            }
        }
        
    }
}