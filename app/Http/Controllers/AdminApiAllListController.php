<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BankUser;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Account;

class AdminApiAllListController extends Controller
{
    public function adminList(){

	 	$user = Admin::where('id',session()->get('adminid'))->first();

	 
	 	$admin = DB::table('bank_users')
	            ->join('admins', 'bank_users.id', '=', 'admins.bank_user_id')
	            ->select('bank_users.*', 'admins.*')
	            ->get();

	    	return response()->json($admin);
	 }

	 public function adminListEdit(Request $request){

	 	$admin = Admin::where('id', $request->id)->first();
    	$bank = BankUser::where('id',$admin->bank_user_id)->first();

	 	return response()->json([
	 		'admin' => $admin,
	 		'bank' => $bank,
	 		'status' => 200,
	 	]);

	 }

	 public function adminListUpdate(Request $request){

    	$Validator=validator::make($request->all(), 
    		[
	     		'fname' => 'required | min:2 | string ',

	     		'lname' => 'required | min:3 | string ',

	     		
	     		'dob' => 'required',

	     		'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',

	     		'email' => 'required | email',

	     		'nid' => 'required',

	     		'ad_name' => 'required | min:2 ',

	     		

	     		'sal' => 'required | integer'
	     	],

	     	[
	     		'fname.required' => 'Please fill up your First Name properly!',
	     		'fname.min' => 'Minimum 2 character',
	     		'lname.required' => 'Please fill up your Last Name properly!',
	     		'lname.min' => 'Minimum 3 character',
	     		
	     		'dob.required' => 'Please select your Date of Birth',
	     		'phone.required' => 'Please enter your phone number',
	     		'email.required' => 'Please fill up your Email properly!',
	     		'nid.required' => 'Please fill your Nid properly!',
	     		'ad_name.required' => 'Please fill up your User Name properly!',
	     		'ad_name.min' => 'Minimum 2 character',
	     		
	     		'password.min' => 'Minimum 8 character',
	     		'sal.required' => 'Please Enter admin salary'

	     	]
    	);

    	if($Validator->fails()){
    		return response()->json([
    			'status'=>422,
    			'errors'=>$Validator->Messages(),

    		]);
    	}else{
    		$admin = Admin::where('id',$request->id)->first();

    		$user = BankUser::where('id',$admin->bank_user_id)->first();
	    	$user->firstname = $request->fname;
	    	$user->lastname = $request->lname;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;


		    
		    $admin->adminname = $request->ad_name; 
		   

		    $password = $admin->password;

		    if ($password != $request->password && $request->password != "") {

		    	$admin->password = md5($request->password);
		    }else{
		    	$admin->password = $password;
		    }

		    $admin->adminsalary = $request->sal;
		    $admin->bank_user_id = $bank_Id;
		    $admin->save();

		    return response()->json([
		    	'message' => 'Updated Succecsfully',
		    	'status' => 200,
		    ]);
		   //return redirect()->route('AdminList');
		}
    }

   

    public function deleteList(Request $request)
    {

    	$admin = Admin::where('id',$request->id)->first();
    	
    	if($admin){
    		$bank_id = $admin->bank_user_id;
	    	$admin->delete();
	    	
	    	$bank = BankUser::where('id',$bank_id)->first();
	    	$bank->delete();

	    	return response()->json([
	    		'status' => 200,
	    		'message' => 'Deleted Succesfully'
	    	]);
    	}else{

    		return response()->json([
    			'status' => 420,
    			'message' => "Admin ID not found!"
    		]);
    	}
    	
    	
    	//return redirect()->route('AdminList');

    }

//End Admin

//Employee

    public function empList(){

    	$emp = DB::table('bank_users')
	            ->join('employees', 'bank_users.id', '=', 'employees.bank_user_id')
	            ->select('bank_users.*', 'employees.*')
	            ->get();

	    	return response()->json($emp);
	 }


	 public function empListEdit(Request $request){

	 	$emp = Employee::where('id', $request->id)->first();
    	$bank = BankUser::where('id',$emp->bank_user_id)->first();

	 	return response()->json([
	 		'emp'=> $emp,
	 		'bank'=> $bank,
	 		'status' => 200
	 	]);

	 }

	 public function empListUpdate(Request $request){

    	$Validator=validator($request->all(), 
    		[
	     		'fname' => 'required | min:2 | string ',

	     		'lname' => 'required | min:3 | string ',

	     		'dob' => 'required',

	     		'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',

	     		'email' => 'required | email',


	     		'nid' => 'required',

	     		'emp_name' => 'required | min:2 ',

	     		'sal' => 'required | integer',

	     		'desig' => 'required',

	     		'joinDate' => 'required',

	     	],

	     	[
	     		'fname.required' => 'Please fill up your First Name properly!',
	     		'fname.min' => 'Minimum 2 character',
	     		'lname.required' => 'Please fill up your Last Name properly!',
	     		'lname.min' => 'Minimum 3 character',
	     		'dob.required' => 'Please fill up Date of Birth!',
	     		'phone.required' => 'Please enter your phone number',
	     		'email.required' => 'Please fill up your Email properly!',
	     		'nid.required' => 'Please fill your Nid properly!',
	     		'emp_name.required' => 'Please fill up your User Name properly!',
	     		'emp_name.min' => 'Minimum 2 character',
	     		'sal.required' => 'Please Enter admin salary',
	     		'desig.required' => 'Please fill up the Designation!',
	     		'joinDate.required' => 'Please fill up Join Date!'

	     	]
    	);

    	if($Validator->fails()){
    		return response()->json([
    			'status'=>422,
    			'errors'=>$Validator->Messages(),

    		]);
    	}else{

	    	$user = BankUser::where('id', $request->id)->first();
	    	$user->firstname = $request->fname;
	    	$user->lastname = $request->lname;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;

		    $emp = Employee::where('bank_user_id', $request->id)->first();


		    $emp->empname = $request->emp_name;

		    $password = $emp->password;

		    if ($password != $request->password && $request->password != "") {

		    	$emp->password = md5($request->password);
		    }else{
		    	$emp->password = $password;
		    }

		    $emp->empsalary = $request->sal;
		    $emp->empdesignation = $request->desig;
		    $emp->joindate = $request->joinDate;
		    $emp->bank_user_id = $bank_Id;
		    $emp->save();

		    return response()->json([
		    	'message' => 'Updated Succecsfully',
		    	'status' => 200,
		    ]);
		}
		   //return redirect()->route('EmpList');

	}

    
    public function deleteEmpList(Request $request)
    {

    	$emp = Employee::where('id',$request->id)->first();
    	
    	if($emp){
	    	$id = $emp->bank_user_id;
	    	$emp->delete();
	    	
	    	$bank = BankUser::where('id',$id)->first();
	    	$bank->delete();

	    	return response()->json([
		    		'status' => 200,
		    		'message' => 'Deleted Succesfully'
	    	]);

    	}else{

    		return response()->json([
    			'status' => 420,
    			'message' => "Employee ID not found!"
    		]);
    	}
    	
    	//return redirect()->route('EmpList');

    }
//End Employee
    
// CUSTOMERS

    public function cusList(){

	 	$account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->where('accounts.accountstate', '=', 'ACTIVE')
	            ->get();

	    	return response()->json($account);;
	 }

	 public function userList(){

	 	$account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->get();

	    	return response()->json($account);;
	 }
    	
     public function cusListEdit(Request $request){

	 	$account = Account::where('id', $request->id)->first();
    	$bank = BankUser::where('id',$account->bank_user_id)->first();

	 	return response()->json([
	 		'account' => $account, 
	 		'bank' => $bank,
	 		'status' => 200
	 	]);

	 }

	 public function cusListUpdate(Request $request){

	 	$Validator=validator($request->all(), 
    		[
	     		'fname' => 'required | min:2 | string ',

	     		'lname' => 'required | min:3 | string ',

	     		'gender' => 'required',

	     		'dob' => 'required',

	     		'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',

	     		'email' => 'required | email',

	     		'nid' => 'required',

	     		'acc_name' => 'required | min:2 ',

	     		'type'=>'required',

	     		'bal' => 'required',

	     		'state' => 'required'
	     	],

	     	[
	     		'fname.required' => 'Please fill up your First Name properly!',
	     		'fname.min' => 'Minimum 2 character',
	     		'lname.required' => 'Please fill up your Last Name properly!',
	     		'lname.min' => 'Minimum 3 character',
	     		'gender.required' => 'Please choose your gender!',
	     		'dob.required' => 'Please fill up Date of Birth!',
	     		'phone.required' => 'Please enter your phone number',
	     		'email.required' => 'Please fill up your Email properly!',
	     		'nid.required' => 'Please fill your Nid properly!',
	     		'acc_name.required' => 'Please fill up your User Name properly!',
	     		'acc_name.min' => 'Minimum 2 character',
	     		'type.required' => 'Please choose your Account Type!',
	     		
	     		'password.min' => 'Minimum 8 character',
	     		'bal.required' => 'Please Enter the account balance!'

	     	]
    	);

    	if($Validator->fails()){
    		return response()->json([
    			'status'=>422,
    			'errors'=>$Validator->Messages(),

    		]);
    	}else{

    		$user = BankUser::where('id', $request->id)->first();
	    	$user->firstname = $request->fname;
	    	$user->lastname = $request->lname;
	    	$user->gender = $request->gender;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;

		    $account = Account::where('bank_user_id', $request->id)->first();

	     	$account->accountname = $request->acc_name;
	     	$account->accounttype = $request->type;

	     	$password = $account->password;

		    if ($password != $request->password && $request->password != "") {

		    	$account->password = md5($request->password);
		    }else{
		    	$account->password = $password;
		    }

	     	$account->accountbalance = $request->bal;

	     	if($request->type=="Savings Account")
                {
                    $account->accountinterestrate=7.50;
                }
            elseif($request->type=="Business Account")
                {
                    $account->accountinterestrate=5.00;
                }
            elseif($request->type=="Student Account")
                {
                    $account->accountinterestrate=10.50;
                }
                
            $account->accountstate=$request->state;
            $account->bank_user_id=$bank_Id;
            $account->save();


	    	return response()->json([
		    	'message' => 'Updated Succecsfully',
		    	'status' => 200,
		    ]);
		}
	}

	 

     public function disableCusList(Request $request)
    {

    	$acc = Account::where('id',$request->id)->first();
    	if($acc){

    		$acc -> accountstate = 'DISABLE';
    		$acc ->save();
			return response()->json([
		    		'status' => 200,
		    		'message' => 'Disabled Succesfully'
	    	]);

    	}else{

    		return response()->json([
    			'status' => 420,
    			'message' => "Account ID not found!"
    		]);
    	}
    	
    	
    	
    	//return redirect()->route('CusList');

    }

    public function customerRequests(){

	 	$account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->where('accounts.accountstate', '=', 'INACTIVE')
	            ->get();

	    

	    	return response()->json($account);

	 }


	public function customerRequestsAccept(Request $request){

		$customer = Account::where('id', $request->id)->first();

		if($customer){
			$customer -> accountstate = 'ACTIVE';
			$customer ->save();
			return response()->json([
	    		'status' => 200,
	    		'message' => 'Account Actived'
	    	]);

		}else{

			return response()->json([
    			'status' => 420,
    			'message' => "Account ID not found!"
    		]);

		}
		
		//return redirect()->route('CustomerRequest');

	}

	public function customerRequestsDisable(Request $request){

		$customer = Account::where('id', $request->id)->first();
		
		if($customer){
			
			$customer -> accountstate = 'DISABLE';
			$customer ->save();
			return response()->json([
	    		'status' => 200,
	    		'message' => 'Account Disabled'
	    	]);
    	}else{

    		return response()->json([
    			'status' => 420,
    			'message' => "Account ID not found!"
    		]);
    	}
		
		
		//return redirect()->route('CustomerRequest');

	}
}
