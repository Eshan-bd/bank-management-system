<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Models\BankUser;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Account;

class AdminAllListController extends Controller
{

// Admin
	public function adminList(){

	 	$user = Admin::where('id',session()->get('adminid'))->first();

	 
	 	$admin = DB::table('bank_users')
	            ->join('admins', 'bank_users.id', '=', 'admins.bank_user_id')
	            ->select('bank_users.*', 'admins.*')
	            ->get();

	    	return view('admin.adminList')->with('admin', $admin);
	 }

	 public function adminListEdit(Request $request){

	 	$admin = Admin::where('id', $request->id)->first();
    	$bank = BankUser::where('id',$admin->bank_user_id)->first();

	 	return view('admin.adminListEdit')->with('admin',$admin)
    									->with('bank',$bank);

	 }

	 public function adminListUpdate(Request $request){

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
	     		
	     		'password.min' => 'Minimum 8 character',
	     		'sal.required' => 'Please Enter admin salary'

	     	]
    	);
    		$admin = Admin::where('id',$request->id)->first();

    		$user = BankUser::where('id',$admin->bank_user_id)->first();
	    	$user->firstname = $request->f_name;
	    	$user->lastname = $request->l_name;
	    	$user->gender = $request->gender;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;


		    
		    $admin->adminname = $request->ad_name; 
		    $admin->password = md5($request->password);
		    $admin->adminsalary = $request->sal;
		    $admin->bank_user_id = $bank_Id;
		    $admin->save();

		   return redirect()->route('AdminList');

    }

    public function editListPicture(Request $request){

    	$user = BankUser::where('id',$request->id)->first();

    	return view('Admin.updateListProfilePic')->with('user',$user);
    }

    public function updateListPicture(Request $request){

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
    	return redirect()->route('AdminList');
    	
    	

    }

    public function deleteList(Request $request)
    {

    	$admin = Admin::where('id',$request->id)->first();
    	$admin->delete();
    	
    	$bank = BankUser::where('id',$request->b_id)->first();
    	$bank->delete();

    	
    	
    	return redirect()->route('AdminList');

    }

//End Admin

//Employee

    public function empList(){

    	$emp = DB::table('bank_users')
	            ->join('employees', 'bank_users.id', '=', 'employees.bank_user_id')
	            ->select('bank_users.*', 'employees.*')
	            ->get();

	    	return view('admin.empList')->with('emp', $emp);
	 }


	 public function empListEdit(Request $request){

	 	$emp = Employee::where('id', $request->id)->first();
    	$bank = BankUser::where('id',$emp->bank_user_id)->first();

	 	return view('admin.emp_edit')
	 									->with('emp',$emp)
    									->with('bank',$bank);

	 }

	 public function empListUpdate(Request $request){

    	$this->validate($request, 
    		[
	     		'f_name' => 'required | min:2 | string ',

	     		'l_name' => 'required | min:3 | string ',

	     		'gender' => 'required',

	     		'dob' => 'required',

	     		'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',

	     		'email' => 'required | email',

	     		'pic' => 'image | nullable | max:1999',

	     		'nid' => 'required',

	     		'emp_name' => 'required | min:2 ',

	     		

	     		'sal' => 'required | integer',

	     		'desig' => 'required',

	     		'joinDate' => 'required',

	     		'doc' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048'
	     	],

	     	[
	     		'f_name.required' => 'Please fill up your First Name properly!',
	     		'f_name.min' => 'Minimum 2 character',
	     		'l_name.required' => 'Please fill up your Last Name properly!',
	     		'l_name.min' => 'Minimum 3 character',
	     		'gender.required' => 'Please choose your gender!',
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

    		

    		
	    	$user = BankUser::where('id', $request->id)->first();
	    	$user->firstname = $request->f_name;
	    	$user->lastname = $request->l_name;
	    	$user->gender = $request->gender;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;

		    $emp = Employee::where('bank_user_id', $request->id)->first();

    		if($request->hasFile('doc')){

	    		$fileWithExt = $request->file('doc')->getClientOriginalName();

	    		$fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('doc')->getClientOriginalExtension();

	    		$fileToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('doc')->storeAs('public/admin/emp_files', $fileToStore);
	     	}else{

	     		$fileToStore = $emp->empdocument;
	     	}

		    $emp->empname = $request->emp_name; 
		    $emp->password = md5($request->password);
		    $emp->empsalary = $request->sal;
		    $emp->empdesignation = $request->desig;
		    $emp->joindate = $request->joinDate;
		    $emp->empdocument = $fileToStore;
		    $emp->bank_user_id = $bank_Id;
		    $emp->save();

		   return redirect()->route('EmpList');

	}

    public function editEmpListPicture(Request $request){

    	$user = BankUser::where('id',$request->id)->first();
    	$emp = Employee::where('bank_user_id',$user->id)->first();

    	return view('Admin.updateEmpListProfilePic')->with('user',$user)->with('emp', $emp);
    }

    public function updateEmpListPicture(Request $request){

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
    	return redirect()->route('EmpList');
    	
    	

    }

    public function deleteEmpList(Request $request)
    {

    	$emp = Employee::where('id',$request->id)->first();
    	$emp->delete();
    	
    	$bank = BankUser::where('id',$request->b_id)->first();
    	$bank->delete();

    	
    	
    	return redirect()->route('EmpList');

    }
//End Employee
    
// CUSTOMERS

    public function cusList(){

	 	$account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->get();

	    	return view('admin.accountList')->with('cus', $account);
	 }
    	
     public function cusListEdit(Request $request){

	 	$account = Account::where('id', $request->id)->first();
    	$bank = BankUser::where('id',$account->bank_user_id)->first();

	 	return view('admin.account_list_edit')
	 									->with('cus',$account)
    									->with('bank',$bank);

	 }

	 public function cusListUpdate(Request $request){

	 	$this->validate($request, 
    		[
	     		'f_name' => 'required | min:2 | string ',

	     		'l_name' => 'required | min:3 | string ',

	     		'gender' => 'required',

	     		'dob' => 'required',

	     		'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',

	     		'email' => 'required | email',

	     		'pic' => 'image | nullable | max:1999',

	     		'nid' => 'required',

	     		'acc_name' => 'required | min:2 ',

	     		'type'=>'required',

	     		'bal' => 'required',

	     		'doc' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048',

	     		'state' => 'required'
	     	],

	     	[
	     		'f_name.required' => 'Please fill up your First Name properly!',
	     		'f_name.min' => 'Minimum 2 character',
	     		'l_name.required' => 'Please fill up your Last Name properly!',
	     		'l_name.min' => 'Minimum 3 character',
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

    		$user = BankUser::where('id', $request->id)->first();
	    	$user->firstname = $request->f_name;
	    	$user->lastname = $request->l_name;
	    	$user->gender = $request->gender;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;

		    $account = Account::where('bank_user_id', $request->id)->first();

    		if($request->hasFile('doc')){

	    		$fileWithExt = $request->file('doc')->getClientOriginalName();

	    		$fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('doc')->getClientOriginalExtension();

	    		$fileToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('doc')->storeAs('public/account/accountdocuments', $fileToStore);
	     	}else{

	     		$fileToStore = $account->accountdocument;
	     	}

	     	$account->accountname = $request->acc_name;
	     	$account->accounttype = $request->type;
	     	$account->password = md5($request->password);
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

            $account->accountdocument = $fileToStore;
                
            $account->accountstate=$request->state;
            $account->bank_user_id=$bank_Id;
            $account->save();

            $account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->get();

	    	return view('admin.accountList')->with('cus', $account);

	 }

	 public function editCusListPicture(Request $request){

    	$user = BankUser::where('id',$request->id)->first();
    	$cus = Account::where('bank_user_id',$user->id)->first();

    	return view('Admin.updateCusListProfilePic')->with('user',$user)->with('cus', $cus);
    }

    public function updateCusListPicture(Request $request){

    	$this->validate($request, 
    		[
    			'pic' => 'image | nullable | max:1999'
    		]);

    	if($request->hasFile('pic')){

	    		$fileNameWithExt = $request->file('pic')->getClientOriginalName();

	    		$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('pic')->getClientOriginalExtension();

	    		$fileNameToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('pic')->storeAs('public/account/profilepictures', $fileNameToStore);
	     	}else{

	     		$user = BankUser::where('id',$request->id)->first();

	     		$fileNameToStore = $user->userprofilepicture;
	     	}


	    $user = BankUser::where('id',$request->id)->first();
    	$user->userprofilepicture = $fileNameToStore;
    	$user->save();
    	return redirect()->route('CusList');
    	
    	

    }

     public function disableCusList(Request $request)
    {

    	$acc = Account::where('id',$request->id)->first();
    	$acc -> accountstate = 'DISABLED';
    	$acc ->save();
    	
    	
    	return redirect()->route('CusList');

    }

    public function customerRequests(){

	 	$account = DB::table('bank_users')
	            ->join('accounts', 'bank_users.id', '=', 'accounts.bank_user_id')
	            ->select('bank_users.*', 'accounts.*')
	            ->get();

	    	return view('admin.customerRequest')->with('cus', $account);
	 }


	public function customerRequestsAccept(Request $request){

		$customer = Account::where('id', $request->id)->first();
		$customer -> accountstate = 'ACTIVE';
		$customer ->save();

		return redirect()->route('CustomerRequest');

	}

	public function customerRequestsDisable(Request $request){

		$customer = Account::where('id', $request->id)->first();
		$customer -> accountstate = 'DISABLED';
		$customer ->save();
		return redirect()->route('CustomerRequest');

	}
}


