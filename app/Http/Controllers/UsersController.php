<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Fpdf;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('privilege','asc')->get();
        // Fpdf::AddPage('P','A4',0);
        // Fpdf::SetFont('Times','B','24');
        // Fpdf::Cell(0,20,'List of Users',0,1,'C');
        // Fpdf::SetFont('Times','B',18);
        // Fpdf::Cell(15,10,'ID',1,0,'C');
        // Fpdf::Cell(65,10,'Name',1,0,'C');
        // Fpdf::Cell(65,10,'Email',1,0,'C');
        // Fpdf::Cell(45,10,'Privilege',1,0,'C');
        // Fpdf::Ln();

        
        // foreach($users as $user){
        //     Fpdf::SetFont('Times','',10);
        //     Fpdf::Cell(15,10,$user->id,1,0,'C');
        //     Fpdf::Cell(65,10,$user->name,1,0,'C');
        //     Fpdf::Cell(65,10,$user->email,1,0,'C');
        //     Fpdf::Cell(45,10,$user->privilege,1,0,'C');
        //     Fpdf::Ln();
        // }
        // return Fpdf::Output('D','users.pdf');
        return view('admin/index')->with('users',$users);
    }
    
    //print PDF
    public function exportUsersPDF(){
        $users = User::orderBy('privilege','asc')->get();
        Fpdf::AddPage('P','A4',0);
        Fpdf::SetFont('Times','B','24');
        Fpdf::Cell(0,20,'List of Users',0,1,'C');
        Fpdf::SetFont('Times','B',18);
        Fpdf::Cell(15,10,'ID',1,0,'C');
        Fpdf::Cell(65,10,'Name',1,0,'C');
        Fpdf::Cell(65,10,'Email',1,0,'C');
        Fpdf::Cell(45,10,'Privilege',1,0,'C');
        Fpdf::Ln();

        
        foreach($users as $user){
            Fpdf::SetFont('Times','',10);
            Fpdf::Cell(15,10,$user->id,1,0,'C');
            Fpdf::Cell(65,10,$user->name,1,0,'C');
            Fpdf::Cell(65,10,$user->email,1,0,'C');
            Fpdf::Cell(45,10,$user->privilege,1,0,'C');
            Fpdf::Ln();
        }
        return Fpdf::Output('D','users.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $data)
    {
        $user = new User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        $user->privilege = $data->privilege; 
        $user->remember_token = str_random();
        $user->save();
        return redirect('/home')->with('success','Succesfully created user.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success','Successfully deleted user '.$user->name);
    }
}
