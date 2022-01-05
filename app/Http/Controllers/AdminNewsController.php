<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\MOdels\News;

class AdminNewsController extends Controller
{
    public function newsCreate(){

    	return view('admin.news');
    }

    public function newsUpdate(Request $request){

    	$this->validate($request, 
    		[
    			'newstitle' => 'required',
    			'newsBody' => 'required',
				'pic'=> 'image|max:1999',
    		],

    		[
    			'newstitle.required'=> 'Please fillup the Titile properly!',
    			'newsBody.required'=> 'Please write the News properly!'
    		]
        );

		$fileNameToStore='';

        if($request->hasFile('pic')){

                $fileNameWithExt = $request->file('pic')->getClientOriginalName();

                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                $ext = $request->file('pic')->getClientOriginalExtension();

                $fileNameToStore = $fileName.'_'.time().'.'.$ext;

                $path = $request->file('pic')->storeAs('public/newsimg', $fileNameToStore);
            }

        	$news = new News();
        	$news->newstitle = $request->newstitle;
        	$news->newsbody =$request->newsBody;
			$news->newspicture=$fileNameToStore;
        	$news-> save();

        	return view('admin.news');
    }
}
