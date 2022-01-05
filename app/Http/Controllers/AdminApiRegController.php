<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\BankUser;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Account;

class AdminApiRegController extends Controller
{



    public function createAdmin(Request $request){

    	$message = [
			     		'fname.required' => 'Please fill up your First Name properly!',
			     		'lname.required' => 'Please fill up your Last Name properly!',
			     		'lname.min' => 'Minimum 3 character',
			     		'gender.required' => 'Please choose your Gender!',
			     		'dob.required' => 'Please select your Date of Birth',
			     		'phone.required' => 'Please Enter Your Phone Number',
			     		'email.required' => 'Please fill up your Email properly!',
			     		'pic.required' => 'Please Upload Your Picture!',
			     		'nid.required' => 'Please fill your Nid properly!',
			     		'ad_name.required' => 'Please fill up your User Name properly!',
			     		'ad_name.min' => 'Minimum 2 character',
			     		'password.required' => 'Please fill up your Password properly!',
			     		'password.min' => 'Minimum 8 character',
			     		'sal.required' => 'Please Enter Admin Salary'

			     	];
    	

    	$Validator=Validator::make($request->all(), 
    		[
	     		'fname' => 'required',

	     		'lname' => 'required | min:3 | string ',

	     		'gender' => 'required',

	     		'dob' => 'required',

	     		'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/',

	     		'email' => 'required | email',

	     		'pic' => ' required |image | nullable | max:1999',

	     		'nid' => 'required',

	     		'ad_name' => 'required | min:2 ',

	     		'password' => 'required | min:8',

	     		'sal' => 'required | integer'
	     	], $message );

    

    	if($Validator->fails()){
    		return response()->json([
    			'status'=>422,
    			'errors'=>$Validator->messages(),

    		]);
    	}else{

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
	    	$user->firstname = $request->fname;
	    	$user->lastname = $request->lname;
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

		   
		    return response()->json([
		    		'status' => 200,
		    		'message' => 'Admin Added Successfully',
		    	]);
		}

		else{

			$bank_Id = $bankers->id;
			$admin = new Admin();
		    $admin->adminname = $request->ad_name; 
		    $admin->password = md5($request->password);
		    $admin->adminsalary = $request->sal;
		    $admin->bank_user_id = $bank_Id;
		    $admin->save();

		   
		     return response()->json([
		    		'status' => 200,
		    		'message' => 'Admin Added Successfully',
		    	]);

		}

    }

    	}

    public function createEmp(Request $request){

    	$Validator=Validator::make($request->all(), 
    		[
	     		'fname' => 'required | min:2 | string ',

	     		'lname' => 'required | min:3 | string ',

	     		'gender' => 'required',

	     		'dob' => 'required',

	     		'phone' => 'required ',

	     		'email' => 'required ',

	     		'pic' => 'required | nullable | max:1999',

	     		'nid' => 'required',

	     		'emp_name' => 'required | min:2 ',

	     		'password' => 'required | min:8',

	     		'sal' => 'required ',

	     		'desig' => 'required',

	     		'joinDate' => 'required',

	     		'doc' => 'required | mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf | max:2048',
	     	],

	     	[
	     		'fname.required' => 'Please fill up your First Name properly!',
	     		'fname.min' => 'Minimum 2 character',
	     		'lname.required' => 'Please fill up your Last Name properly!',
	     		'lname.min' => 'Minimum 3 character',
	     		'gender.required' => 'Please choose your Gender!',
	     		'dob.required' => 'Please fill up Date of Birth!',
	     		'phone.required' => 'Please enter your Phone Number',
	     		'email.required' => 'Please fill up your Email properly!',
	     		'pic.required' => 'Please Upload Profile Picture!',
	     		'nid.required' => 'Please fill your Nid properly!',
	     		'emp_name.required' => 'Please fill up your User Name properly!',
	     		'emp_name.min' => 'Minimum 2 character',
	     		'password.required' => 'Please fill up your password properly!',
	     		'password.min' => 'Minimum 8 character',
	     		'sal.required' => 'Please Enter Admin Salary',
	     		'desig.required' => 'Please fill up the Designation!',
	     		'joinDate.required' => 'Please fill up Join Date!',
	     		'doc.required' => 'Please Upload Documents!',

	     	]
    	);

    	if($Validator->fails()){
    		return response()->json([
    			'status'=>422,
    			'errors'=>$Validator->Messages(),
    		]);
    	}else{

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
	    	$user->firstname = $request->fname;
	    	$user->lastname = $request->lname;
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

		   
		    return response()->json([
		    		'status' => 200,
		    		'message' => 'Employee Added Successfully',
		    	]);
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

		   
		    return response()->json([
		    		'status' => 200,
		    		'message' => 'Employee Added Successfully',
		    	]);

    	}
    }

}
    	
}
