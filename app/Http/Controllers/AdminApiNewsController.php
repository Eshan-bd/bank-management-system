<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MOdels\News;
use Illuminate\Support\Facades\Validator;

class AdminApiNewsController extends Controller
{
    public function newsUpdate(Request $request){

    	$Validator=Validator::make($request->all(), 
    		[
    			'newsTitle' => 'required',
    			'newsBody' => 'required',
				'pic'=> 'image|max:1999',
    		],

    		[
    			'newsTitle.required'=> 'Please fillup the Titile properly!',
    			'newsBody.required'=> 'Please write the News properly!'
    		]
        );

        if($Validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$Validator->Messages(),

            ]);
        }else{

		$fileNameToStore='';

        if($request->hasFile('pic')){

                $fileNameWithExt = $request->file('pic')->getClientOriginalName();

                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                $ext = $request->file('pic')->getClientOriginalExtension();

                $fileNameToStore = $fileName.'_'.time().'.'.$ext;

                $path = $request->file('pic')->storeAs('public/newsimg', $fileNameToStore);
            }

        	$news = new News();
        	$news->newstitle = $request->newsTitle;
        	$news->newsbody =$request->newsBody;
			$news->newspicture=$fileNameToStore;
        	$news-> save();

        	return response()->json([
                'message' => 'Updated Succecsfully',
                'status' => 200,
            ]);
           //return redirect()->route('AdminProfile');
        }
}
}
