<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PDFController extends Controller
{
    function index(){
        return view('dynamic_pdf')->with('customer_data',$customer_data);
    }
}
