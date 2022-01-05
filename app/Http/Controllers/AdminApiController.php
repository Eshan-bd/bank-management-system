<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankUser;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Account;
use App\Models\History;
use Illuminate\Support\Facades\Validator;

class AdminApiController extends Controller
{

	 public function adminInformation(Request $request){

    	$admin = Admin::where('id',$request->id)->first();
   
    	return response()->json($admin);
    }

    public function bankInformation(Request $request){

    	$bank = BankUser::where('id',$request->id)->first();
   
    	return response()->json($bank);
    }

    public function adminDashboard(){

    	$admins = Admin::all();
    	$employees = Employee::all();
    	$customers = Account::all();
    	
    	$adminNo=$admins->count();
    	$empNo=$employees->count();
    	$cusNo=$customers->count();

    	return response()->json( [
    		'adminsNo' => $adminNo, 
    		'employeesNo' => $empNo, 
    		'accountNo'=>$cusNo,
    		'status'=> 200
    	]);
    }

    public function adminProfile(Request $request){

    	$admin = Admin::where('id',$request->id)->first();
    	$bank = BankUser::where('id',$admin->bank_user_id)->first();
    	return response()->json( [
    		'admin' => $admin, 
    		'bank' => $bank,
    		'status' =>200,
    	]);
    }

    public function adminEdit(){

    	$admin = Admin::where('id',2)->first();
    	$bank = BankUser::where('id',$admin->bank_user_id)->first();
    	return response()->json( [$admin, $bank]);

    }

    public function adminUpdate(Request $request){

    	$Validator=Validator::make($request->all(), 
    		[
	     		'fname' => 'required ',

	     		'lname' => 'required ',

	     		'dob' => 'required',

	     		'phone' => 'required ',

	     		'email' => 'required ',

	     		'nid' => 'required',

	     		'ad_name' => 'required | min:2 ',

	     		'password' => 'required | min:8',

	     		'sal' => 'required '
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
	     		'password.required' => 'Please fill up your password properly!',
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

    		$user = BankUser::where('id',$request->b_id)->first();
	    	$user->firstname = $request->fname;
	    	$user->lastname = $request->lname;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;


		    $admin = Admin::where('id',$request->ad_id)->first();
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
		   //return redirect()->route('AdminProfile');
		}
    }




    public function updatePicture(Request $request){

    	$Validator=Validator($request->all(), 
    		[
    			'pic' => 'image | nullable | max:1999'
    		]);

    	if($request->hasFile('pic')){

	    		$fileNameWithExt = $request->file('pic')->getClientOriginalName();

	    		$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('pic')->getClientOriginalExtension();

	    		$fileNameToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('pic')->storeAs('public/admin/admin_cover_images', $fileNameToStore);
	     	}else{

	     		$user = BankUser::where('id',$request->id)->first();

	     		$fileNameToStore = $user->userprofilepicture;
	     	}


	    $user = BankUser::where('id',$request->id)->first();
    	$user->userprofilepicture = $fileNameToStore;
    	$user->save();
    	return response()->json([
    		'status' => 200,
    		'message' => 'Uploaded Succecsfully!'
    	]);
    	
    	

    }

    

    public function history(){

    	
    		$history = History::all();
	    	$credit = History::sum('credit');
	    	$debit = History::sum('debit');
	    	$balance = 10000000+($credit - $debit);
	    	return response()->json([
	    		'history' => $history,
	    		'credit' => $credit,
	    		'debit' => $debit,
	    		'balance' => $balance,
	    		'status' => 200
	    	]);
    	

    	
    }

    public function accountAllList(){

    	$account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->get();

	    	return response()->json($account);
    }
}
