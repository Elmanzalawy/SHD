<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome to SHD';
        return view('pages.index')->with('title',$title);
    }
    public function about(){
        $data = array(
            'title'=>'About Us',
            'key'=>'value',
            'services'=> ['Web Design','Video Editing']
        );
        return view('pages.about')->with($data);
    }

}
