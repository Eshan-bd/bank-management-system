<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use PDF;

class PdfController extends Controller
{
    public function downloadPdf(){
    	$history = History::all();
    	$credit = History::sum('credit');
	    $debit = History::sum('debit');
	    $balance = 10000000 + ($credit - $debit);

    	$pdf = PDF::loadview('admin.transactionPdf', ['history'=> $history, 'credit'=>$credit, 'debit'=>$debit, 'balance'=>$balance])
    	->setOptions(['defaultFont' => 'sans-serif'])
    	->setPaper('a4','landscape') ;

    	return $pdf->download('history.pdf');
    }
}
