<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LectureArchive;
// use codedge\Fpdf\Facades\Fpdf;
use Fpdf;
use DB;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
class LecturesController extends Controller
{

    // add authentication to events
    public function __construct()
    {
        //if user is guest, redirect to login screen except index and show views
        $this->middleware('auth',['except' => ['level1','level2','level3','level4','level5']]);
    }

    public function level1(){
        $data = array(
            'LectureArchive' => LectureArchive::orderBy('type','asc')->get(),
            'level'=>1,
            'departments'=>['general'],
            'subjects'=>['Physics 1','Physics 2','Math 1','Math 2','Mechanics 1','Mechanics 2','Computer Systems','Engineering Chemistry','Introduction to Engineering and Environment','Production','Engineering Drawing','Language 1']
        );
        return view('lectures.level1')->with($data);
    }
    public function level2(){
        $data = array(
            'LectureArchive' => LectureArchive::orderBy('type','asc')->get(),
            'level'=>2,
            'departments'=>['general','civil','communication','chemical'],
            'subjects'=>
            [
                'general'=>['IT','Java Programming','Math 3','Math 4','Thermodynamics','Electric Engineering','Language 2','Fluid Mechanics'],
                'civil'=>['Structure 1','Surveying 1','Civil Drawing 1','Strength of Materials'],
                'communication'=>['Electronics 1','Electronics 2','Test 1','Report Writing'],
                'chemical'=>['Report Writing','Strength of Materials','Organic Chemistry','Non-organic Chemistry']
            ]
        );
        return view('lectures.level2')->with($data);
    }
    public function level3(){
        $data = array(
            'LectureArchive' => LectureArchive::orderBy('type','asc')->get(),
            'level'=>3,
            'departments'=>['general','civil','communication','chemical'],
            'subjects'=>
            [
                'general'=>['Engineering Economy','Numerical Methods','Statistics Analysis'],
                'civil'=>['Report Writing','Structure 2','Structure 3','Surveying 2','Hydrology and Irrigation','Reinforced Concrete 1','Properties and Strength of Materials','Geology and Soil Mechanics 1','Traffic and Transportation'],
                'communication'=>['Electromagnetics','Electronic Circuits 1','Electronic Tests 2','Electronic Measurements','Logic Circuits','Computer Organization','Engineering Management','Control Systems','Advanced Java'],
                'chemical'=>['Organic Chemistry','Operation Research 1','Organic Chemistry','Analytical Chemistry','Chemical Engieering Principles 1','Chemical Engieering Principles 2','Heat Transfer','Metallurgy','Control Systems']
            ]
        );
        return view('lectures.level3')->with($data);
    }

    //LEVEL 4 lecture ARCHIVE
    public function level4(){
        $data = array(
            'LectureArchive' => LectureArchive::orderBy('type','asc')->get(),
            'level'=>4,
            'departments'=>['general','civil','communication','chemical'],
            'subjects'=>
            [
                'general'=>['Environmental Management','Project Management 1'],
                'civil'=>['Steel 1','Steel 2','Reinforced Concrete 3','River Engineering','Soil Mechanics','Highway and Airport'],
                'communication'=>['Electromagnetic Waves','Electronic Circuits 2','Electronic Tests 3','Electronic Tests 4','Wireless Communication','Electronic Design','Integrated Circuits','Microprocessor Systems','Microwave Engineering','Printed Circuits','Optical Semiconductors','Signal Analysis','VLSI','Mobile Communication'],
                'chemical'=>['Chemical Thermodynamics','Bio-Organic Chemistry','Gas Engineering','Mass Transfer Operations','Mechanical Unit Operation','Petrol Refining','Polymer Engineering','Reactor Design']
            ]
        );
        return view('lectures.level4')->with($data);
    }
    //LEVEL 5 lecture ARCHIVE
    public function level5(){
        $data = array(
            'LectureArchive' => LectureArchive::orderBy('type','asc')->get(),
            'level'=>5 ,
            'departments'=>['general','civil','communication','chemical'],
            'subjects'=>
            [
                'general'=>['Environmental Management','Project Management 1','Project Management 2'],
                'civil'=>['Steel 1','Steel 2','Reinforced Concrete 3','River Engineering','Soil Mechanics','Highway and Airport'],
                'communication'=>['Electromagnetic Waves','Electronic Circuits 2','Electronic Tests 3','Electronic Tests 4','Electronic Design','Integrated Circuits','Microprocessor Systems','Microwave Engineering','Printed Circuits','Optical Semiconductor','Signal Analysis','VLSI','Telecommunication'],
                'chemical'=>['Chemical Thermodynamics','Bio-Organic Chemistry','Gas Engineering','Mass Transfer Operations','Mechanical Unit Operation','Petrol Refining','Polymer Engineering','Reactor Design']
            ]
        );
        return view('lectures.level5')->with($data);
    }

    
    public function uploadLecture(Request $request, $level)
    {

                 //Send mail to notify admins
                 Mail::to("test.elmanzalawy98@gmail.com")->send(new Mailer());
                 
        $this->validate($request, [
            'subject'=>'required',
            'type'=>'required',
            // 'filename'=> 'required',
            'lectures[]' => 'mimes:jpeg,png,jpg,gif|max:100000' //file size in kb
            // 'lectures[]'=>'required'
        ]);

        // insert file handling here
        $subject = $request->subject;
        $type = $request->type;


        $lecture = new lectureArchive;
        $lecture->subject = $request->subject;
        $lecture->type = $request->type;
        $lecture->user_id = auth()->user()->id;
        $lecture->username = auth()->user()->name;
        $lecture->fileNumber = 1 + LectureArchive::where('subject',$lecture->subject)->where('type',$type)->count();

        $numOfLectures = 1 + DB::table('lecture_archive')->where('subject',$lecture->subject)->where('type',$lecture->type)->count(); //returns the number of lectures from the same subject, used to increment each new lecture.
        $lecture->filename = $subject."_".$type."_".$numOfLectures.".pdf";
        //check if file already exists.
        if($duplicateFile = lectureArchive::where('filename','like',$lecture->filename)->exists()){
            $numDuplicates = lectureArchive::where('filename',$lecture->filename)->count();
            $newName = $subject."_".$type."_".time().".pdf";
            $lecture->filename = $newName;
        }
        if($request->hasfile('lectures'))
         {
             $imgArr = array([count($request->lectures)]);
             $i=0;
            foreach($request->file('lectures') as $file)
            {
                $name=$file->getClientOriginalName();  //returns the full name of each file
                $extension = $file->getClientOriginalExtension();  //returns the extension of each file
                $imageArray = array();
                // if($extension==='pdf'){
                //     $name = $lecture->filename;
                //     //check if file already exists.
                //     if($duplicateFile = lectureArchive::where('filename','like',$name)->exists()){
                //         $numDuplicates = lectureArchive::where('filename',$name)->count();
                //         $newName = $subject."_".$type."_".$year."_".time().".pdf";
                //         $name = $newName;
                //     }
                //     $file->storeAs('public/lecture_archive',$name);
                //     $lecture->save();

                //     return redirect('lectures/level'.$level.'.php')->with('success','File uploaded: '.$lecture->filename);
                //     break; //break the foreach loop
                // }
                if($extension=='pdf' || $extension=='docx' || $extension=='ppt' || $extension=='pptx'){
                    $lecture->filename = str_replace("pdf",$extension, $lecture->filename); //replace .pdf extension with appropriate file extension
                    $name = $lecture->filename;
                    //check if file already exists.
                    if($duplicateFile = lectureArchive::where('filename','like',$name)->exists()){
                        $numDuplicates = lectureArchive::where('filename',$name)->count();
                        $newName = $subject."_".$type."_".$year."_".time().".".$extension;
                        $name = $newName;
                    }
                    $file->storeAs('public/lecture_archive',$name);
                    $lecture->save();

                    return redirect('lectures/level'.$level.'.php')->with('success','File uploaded: '.$lecture->filename);
                    break; //break the foreach loop
                }
                elseif($extension=="jpg" || $extension=="jpeg" || $extension=="png" || $extension=="pneg" || $extension=="gif"){
                    $name = $lecture->filename;
                    //check if file already exists.
                    if($duplicateFile = lectureArchive::where('filename','like',$name)->exists()){
                        $numDuplicates = lectureArchive::where('filename',$name)->count();
                        $newName = $subject."_".$type."_".$year."_".time().".pdf";
                        $name = $newName;
                    }
                    //store image and add it to image array
                    $file->storeAs('public/lecture_archive',$file->getClientOriginalName());
                    $imageArr[$i] = $file->getClientOriginalName();
                    $i++;
                }
                else{
                    return redirect('lectures/level'.$level.'.php')->with('error','Invalid file type');
                }

            }
            if(count($imageArr)>0){
                foreach($imageArr as $image){
                    Fpdf::AddPage();
                    Fpdf::SetFont('Courier', 'B', 18);
                    Fpdf::Image('storage/lecture_archive/'.$image, 0, 0, 210, 297,$extension);
                    //delete temporary pictures after they are converted into pdf
                    unlink('./../storage/app/public/lecture_archive/'.$image);
                }
                Fpdf::Output('storage/lecture_archive/'.$lecture->filename,'F');
            }
            // $filename = 'public/lecture_archive/'.'pdfname.pdf';
            // $pdf->Output($filename,'F');
            $lecture->save();
            return redirect('lectures/level'.$level.'.php')->with('success','File uploaded: '.$lecture->filename);
         }
         else{
             return redirect('lectures/level'.$level.'.php')->with('error','Error: invalid form data.');
         }

        
    }

    public function destroy($id)
    {
        $lecture = lectureArchive::find($id);
        $level = $lecture->level;
        $filename = $lecture->filename;
        //check for user id
        if(auth()->user()->privilege == 'admin'){
            $lecture->delete();
            if(file_exists('./../storage/app/public/lecture_archive/'.$filename)){
                unlink('./../storage/app/public/lecture_archive/'.$filename);
            }
            return back()->with('success','Lecture deleted.');
        }
        return back()->with('error',"Unauthorized User.");
        
    }
}
