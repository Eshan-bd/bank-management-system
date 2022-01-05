<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BankUser;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Account;

class AdminRegController extends Controller
{
    public function adminRegistration(){

    	return view('admin.adminReg');
    }

    public function empRegistration(){

    	return view('admin.empReg');
    }

    public function customerRegistration(){

    	return view('admin.customerReg');
    }

    public function createAdmin(Request $request){

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

    	$bankers = BankUser::where('nid', $request->nid)->first();

    	if(!$bankers){

	    	if($request->hasFile('pic')){

	    		$fileNameWithExt = $request->file('pic')->getClientOriginalName();

	    		$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('pic')->getClientOriginalExtension();

	    		$fileNameToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('pic')->storeAs('public/admin/admin_cover_images', $fileNameToStore);
	     	}else{

	     		$fileNameToStore = 'noimage.jpg';
	     	}

	    	$user = new BankUser();
	    	$user->firstname = $request->f_name;
	    	$user->lastname = $request->l_name;
	    	$user->gender = $request->gender;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->userprofilepicture = $fileNameToStore;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;


		    $admin = new Admin();
		    $admin->adminname = $request->ad_name; 
		    $admin->password = md5($request->password);
		    $admin->adminsalary = $request->sal;
		    $admin->bank_user_id = $bank_Id;
		    $admin->save();

		   
		    return redirect()->route('RegAdmin');
		}

		else{

			$bank_Id = $bankers->id;
			$admin = new Admin();
		    $admin->adminname = $request->ad_name; 
		    $admin->password = md5($request->password);
		    $admin->adminsalary = $request->sal;
		    $admin->bank_user_id = $bank_Id;
		    $admin->save();

		   
		    return redirect()->route('RegAdmin');

		}

    }

    public function createEmp(Request $request){

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

	     		'password' => 'required | min:8',

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
	     		'password.required' => 'Please fill up your password properly!',
	     		'password.min' => 'Minimum 8 character',
	     		'sal.required' => 'Please Enter admin salary',
	     		'desig.required' => 'Please fill up the Designation!',
	     		'joinDate.required' => 'Please fill up Join Date!'

	     	]
    	);

    	$bankers = BankUser::where('nid', $request->nid)->first();

    	if(!$bankers){

	    	if($request->hasFile('pic')){

	    		$fileNameWithExt = $request->file('pic')->getClientOriginalName();

	    		$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('pic')->getClientOriginalExtension();

	    		$fileNameToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('pic')->storeAs('public/admin/admin_cover_images', $fileNameToStore);
	     	}else{

	     		$fileNameToStore = 'noimage.jpg';
	     	}


	     	if($request->hasFile('doc')){

	    		$fileWithExt = $request->file('doc')->getClientOriginalName();

	    		$fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('doc')->getClientOriginalExtension();

	    		$fileToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('doc')->storeAs('public/admin/emp_files', $fileToStore);
	     	}else{

	     		$fileToStore = 'nofile.pdf';
	     	}


	    	$user = new BankUser();
	    	$user->firstname = $request->f_name;
	    	$user->lastname = $request->l_name;
	    	$user->gender = $request->gender;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->userprofilepicture = $fileNameToStore;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;


		    $emp = new Employee();
		    $emp->empname = $request->emp_name; 
		    $emp->password = md5($request->password);
		    $emp->empsalary = $request->sal;
		    $emp->empdesignation = $request->desig;
		    $emp->joindate = $request->joinDate;
		    $emp->empdocument = $fileToStore;
		    $emp->bank_user_id = $bank_Id;
		    $emp->save();

		   
		    return redirect()->route('RegEmp');
    	}

    	else{

	    	if($request->hasFile('doc')){

	    		$fileWithExt = $request->file('doc')->getClientOriginalName();

	    		$fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('doc')->getClientOriginalExtension();

	    		$fileToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('doc')->storeAs('public/admin/emp_files', $fileToStore);
	     	}else{

	     		$fileToStore = 'nofile.pdf';
	     	}

	     	$bank_Id = $bankers->id;

	     	$emp = new Employee();
		    $emp->empname = $request->emp_name; 
		    $emp->password = md5($request->password);
		    $emp->empsalary = $request->sal;
		    $emp->empdesignation = $request->desig;
		    $emp->joindate = $request->joinDate;
		    $emp->empdocument = $fileToStore;
		    $emp->bank_user_id = $bank_Id;
		    $emp->save();

		   
		    return redirect()->route('RegEmp');

    	}
    }



    	public function createCustomer(Request $request){

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

	     		'doc' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf|max:2048',

	     		'type' => 'required',

	     		'acc_name' => 'required | min:2 ',

	     		'password' => 'required | min:8',
	  
	     		'bal' => 'required',

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
	     		'type.required' => 'Please choose your Account Type!',
	     		'acc_name.required' => 'Please fill up your Account Name properly!',
	     		'acc_name.min' => 'Minimum 2 character',
	     		'password.required' => 'Please fill up your password properly!',
	     		'password.min' => 'Minimum 8 character',
	     		'bal.required' => 'Please Enter Account Balance',
	     		'state.required' => 'Please Select Account Current State!'

	     	]
    	);

    	$bankers = BankUser::where('nid', $request->nid)->first();

    	if(!$bankers){

	    	if($request->hasFile('pic')){

	    		$fileNameWithExt = $request->file('pic')->getClientOriginalName();

	    		$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('pic')->getClientOriginalExtension();

	    		$fileNameToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('pic')->storeAs('public/account/profilepictures', $fileNameToStore);

	     	}else{

	     		$fileNameToStore = 'noimage.jpg';
	     	}


	     	if($request->hasFile('doc')){

	    		$fileWithExt = $request->file('doc')->getClientOriginalName();

	    		$fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('doc')->getClientOriginalExtension();

	    		$fileToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('doc')->storeAs('public/account/accountdocuments', $fileToStore);
	     	}else{

	     		$fileToStore = 'nofile.pdf';
	     	}


	    	$user = new BankUser();
	    	$user->firstname = $request->f_name;
	    	$user->lastname = $request->l_name;
	    	$user->gender = $request->gender;
	    	$user->dateofbirth = $request->dob;
	    	$user->phone = $request->phone;
		    $user->email = $request->email;
		    $user->userprofilepicture = $fileNameToStore;
		    $user->nid = $request->nid;
		    $user->save();

		    $bank_Id =  $user->id;


		    $account = new Account();
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

		   
		    return redirect()->route('RegCustomer');
    	}

    	else{

	    	if($request->hasFile('doc')){

	    		$fileWithExt = $request->file('doc')->getClientOriginalName();

	    		$fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

	    		$ext = $request->file('doc')->getClientOriginalExtension();

	    		$fileToStore = $fileName.'_'.time().'.'.$ext;

	    		$path = $request->file('doc')->storeAs('public/account/accountdocuments', $fileToStore);
	     	}else{

	     		$fileToStore = 'nofile.pdf';
	     	}

	     	$bank_Id = $bankers->id;

	     	$account = new Account();
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

		   
		    return redirect()->route('Regustomer');

    	}

    	

    }
}
