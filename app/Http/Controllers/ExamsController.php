<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExamArchive;
// use codedge\Fpdf\Facades\Fpdf;
use Fpdf;
use DB;
class ExamsController extends Controller
{

    // add authentication to events
    public function __construct()
    {
        //if user is guest, redirect to login screen except index and show views
        $this->middleware('auth',['except' => ['level1','level2','level3','level4','level5']]);
    }

    public function level1(){
        $data = array(
            'ExamArchive' => ExamArchive::orderBy('year','desc')->get(),
            'level'=>1,
            'departments'=>['general'],
            'subjects'=>['Physics 1','Physics 2','Math 1','Math 2','Mechanics 1','Mechanics 2','Computer Systems','Engineering Chemistry','Introduction to Engineering and Environment','Production','Engineering Drawing','Language 1']
        );
        return view('exams.level1')->with($data);
    }
    public function level2(){
        $data = array(
            'ExamArchive' => ExamArchive::orderBy('year','desc')->get(),
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
        return view('exams.level2')->with($data);
    }
    public function level3(){
        $data = array(
            'ExamArchive' => ExamArchive::orderBy('year','desc')->get(),
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
        return view('exams.level3')->with($data);
    }

    //LEVEL 4 EXAM ARCHIVE
    public function level4(){
        $data = array(
            'ExamArchive' => ExamArchive::orderBy('year','desc')->get(),
            'level'=>4,
            'departments'=>['general','civil','communication','chemical'],
            'subjects'=>
            [
                'general'=>['Environmental Management','Project Management 1','Project Management 2'],
                'civil'=>['Steel 1','Steel 2','Reinforced Concrete 3','River Engineering','Soil Mechanics','Highway and Airport'],
                'communication'=>['Electromagnetic Waves','Electronic Circuits 2','Electronic Tests 3','Electronic Tests 4','Wireless Communication','Electronic Design','Integrated Circuits','Microprocessor Systems','Microwave Engineering','Printed Circuits','Optical Semiconductors','Signal Analysis','VLSI','Mobile Communication'],
                'chemical'=>['Chemical Thermodynamics','Bio-Organic Chemistry','Gas Engineering','Mass Transfer Operations','Mechanical Unit Operation','Petrol Refining','Polymer Engineering','Reactor Design']
            ]
        );
        return view('exams.level4')->with($data);
    }
    //LEVEL 5 EXAM ARCHIVE
    public function level5(){
        $data = array(
            'ExamArchive' => ExamArchive::orderBy('year','desc')->get(),
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
        return view('exams.level5')->with($data);
    }
    public function uploadExam(Request $request, $level)
    {

        $this->validate($request, [
            'subject'=>'required',
            'type'=>'required',
            'year'=>'required',
            // 'filename'=> 'required',
            'exams[]' => 'mimes:jpeg,png,jpg,gif|max:100000' //file size in kb
            // 'exams[]'=>'required'
        ]);

        // insert file handling here
        $subject = $request->subject;
        $type = $request->type;
        $year = $request->year;


        $exam = new ExamArchive;
        $exam->level = $level;
        $exam->subject = $request->subject;
        $exam->type = $request->type;
        $exam->year = $request->year;
        $exam->user_id = auth()->user()->id;
        $exam->username = auth()->user()->name;
        $exam->filename = $subject."_".$type."_".$year.".pdf";
        //check if file already exists.
        if($duplicateFile = ExamArchive::where('filename','like',$exam->filename)->exists()){
            $numDuplicates = ExamArchive::where('filename',$exam->filename)->count();
            $newName = $subject."_".$type."_".$year."_".time().".pdf";
            $exam->filename = $newName;
        }
        if($request->hasfile('exams'))
         {
             $imgArr = array([count($request->exams)]);
             $i=0;
            foreach($request->file('exams') as $file)
            {
                $name=$file->getClientOriginalName();  //returns the full name of each file
                $extension = $file->getClientOriginalExtension();  //returns the extension of each file
                $imageArray = array();
                if($extension==='pdf'){
                    $name = $exam->filename;
                    //check if file already exists.
                    if($duplicateFile = ExamArchive::where('filename','like',$name)->exists()){
                        $numDuplicates = ExamArchive::where('filename',$name)->count();
                        $newName = $subject."_".$type."_".$year."_".time().".pdf";
                        $name = $newName;
                    }
                    $file->storeAs('public/exam_archive',$name);
                    $exam->save();

                    return redirect('exams/level'.$level.'.php');
                    break; //break the foreach loop
                }
                elseif($extension=="jpg" || $extension=="jpeg" || $extension=="png" || $extension=="pneg" || $extension=="gif"){
                    $name = $exam->filename;
                    //check if file already exists.
                    if($duplicateFile = ExamArchive::where('filename','like',$name)->exists()){
                        $numDuplicates = ExamArchive::where('filename',$name)->count();
                        $newName = $subject."_".$type."_".$year."_".time().".pdf";
                        $name = $newName;
                    }
                    //store image and add it to image array
                    $file->storeAs('public/exam_archive',$file->getClientOriginalName());
                    $imageArr[$i] = $file->getClientOriginalName();
                    $i++;
                }
                else{
                    return redirect('exams/level'.$level.'.php')->with('error','Invalid file type');
                }

            }
            if(count($imageArr)>0){
                echo "<script>'test'</script>";
                foreach($imageArr as $image){
                    Fpdf::AddPage();
                    Fpdf::SetFont('Courier', 'B', 18);
                    Fpdf::Image('storage/exam_archive/'.$image, 0, 0, 210, 297,$extension);
                    //delete temporary pictures after they are converted into pdf
                    unlink('./../storage/app/public/exam_archive/'.$image);
                }
                Fpdf::Output('storage/exam_archive/'.$exam->filename,'F');
            }
            // $filename = 'public/exam_archive/'.'pdfname.pdf';
            // $pdf->Output($filename,'F');
         }

        $exam->save();
        return back()->with('success','Exam uploaded.');
    }

    public function destroy($id)
    {
        $exam = ExamArchive::find($id);
        $level = $exam->level;
        $filename = $exam->filename;
        //check for user id
        if(auth()->user()->privilege == 'admin'){
            $exam->delete();
            if(file_exists('./../storage/app/public/exam_archive/'.$filename)){
                unlink('./../storage/app/public/exam_archive/'.$filename);
            }
            return back()->with('success','Exam Deleted');
        }
        return back()->with('error',"Unauthorized User");
        
    }
}
