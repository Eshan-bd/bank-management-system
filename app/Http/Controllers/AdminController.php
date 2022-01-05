<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\BankUser;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Account;
use App\Models\History;

class AdminController extends Controller
{
    public function adminDashboard(){

    	$admins = Admin::all();
    	$employees = Employee::all();
    	$customers = Account::all();

    	$No = 0;
    	foreach ($customers as $customer) {
    		if($customer ->accountstate == 'ACTIVE'){

    			$No++;
    		}
    	}

    	$customerNo= $No;

    	return view('Admin.Dashboard')
    				->with('admins', $admins)
    				->with('employees', $employees)
    				->with('customers', $customers)
    				->with('customerNumber', $customerNo);
    }

    public function adminProfile(){

    	$admin = Admin::where('id',session()->get('adminid'))->first();
    	$bank = BankUser::where('id',$admin->bank_user_id)->first();
    	return view('admin.viewProfile')->with('admin',$admin)
    									->with('bank',$bank);
    }

    public function adminEdit(){

    	$admin = Admin::where('id',session()->get('adminid'))->first();
    	$bank = BankUser::where('id',$admin->bank_user_id)->first();
    	return view('Admin.Edit')->with('admin',$admin)
    									->with('bank',$bank);

    }

    public function adminUpdate(Request $request){

    	$this->validate($request, 
    		[
	     		'f_name' => 'required | min:2 | string ',

	     		'l_name' => 'required | min:3 | string ',

	     		'gender' => 'required',

	     		'dob' => 'required',

	     		'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',

	     		'email' => 'required | email',

	     		'nid' => 'required',

	     		'ad_name' => 'required | min:2 ',

	     		'password' => 'required | min:8',

	     		'sal' => 'required | integer'
	     	],

	     	[
	     		'f_name.required' => 'Please fill up your First Name properly!',
	     		'f_name.min' => 'Minimum 2 character',
	     		'l_name.required' => 'Please fill up your Last Name properly!',
	     		'l_name.min' => 'Minimum 3 character',
	     		'gender.required' => 'Please choose your gender!',
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

    		$user = BankUser::where('id',$request->b_id)->first();
	    	$user->firstname = $request->f_name;
	    	$user->lastname = $request->l_name;
	    	$user->gender = $request->gender;
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

		   return redirect()->route('AdminProfile');

    }

    public function editPicture(Request $request){

    	$user = BankUser::where('id',$request->id)->first();

    	return view('Admin.updateProfilePic')->with('user',$user);
    }

    public function updatePicture(Request $request){

    	$this->validate($request, 
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
    	return redirect()->route('AdminProfile');
    	
    	

    }


    public function history(Request $request){

    	if(!empty($request->search)){

    		$history = History::where('account_id','like','%'.$request->search.'%')->get();
    		$credit = History::sum('credit');
	    	$debit = History::sum('debit');
	    	$balance = $credit - $debit;
	    	return view('admin.admin_history')
	    			->with('history', $history)
	    			->with('credit', $credit)
	    			->with('debit', $debit)
	    			->with('balance', $balance);

    	}else{

    		$history = History::all();
	    	$credit = History::sum('credit');
	    	$debit = History::sum('debit');
	    	$balance = 10000000+($credit - $debit);
	    	return view('admin.admin_history')
	    			->with('history', $history)
	    			->with('credit', $credit)
	    			->with('debit', $debit)
	    			->with('balance', $balance);
    	}

    	
    }

    public function accountAllList(){

    	$account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->get();

	    	return view('admin.account_all_list')->with('cus', $account);
    }
}
