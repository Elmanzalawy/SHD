<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\EventRegister;
use Fpdf;
// use PDF;
use DB;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // add authentication to events
    public function __construct()
    {
        //if user is guest, redirect to login screen except index and show views
        $this->middleware('auth',['except' => ['index','show']]);
    }


    public function index()
    {
        // $events = Event::orderBy('id','desc')->get();
        // $event = Post::where('id','2')->get();
        // $posts = DB::select('SELECT * FROM posts');
        $events = Event::orderBy('created_at','desc')->paginate(3);
        return view('events.index')->with('events',$events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'description'=>'required',
            'cover_image'=> 'image|nullable|max:10000'
        ]);
        //handle file upload
        $filenameToStore = "placeholder-image.png";
        if($request->hasFile('cover_image')){
            //Get file name with extentsion
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename."_".time().".".$extension; // making the filename unique to prevent image overwriting

            //Upload image
            $path = $request->file('cover_image')->storeAs('public/event_images',$filenameToStore);

        }
        else{
            // $fileNameToStore = "placeholder-image.png";
        }
        //create event
        $event = new Event;
        $event->organizer_id = auth()->user()->id;
        $event->organizer = auth()->user()->name;
        $event->cover_image = $filenameToStore;
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->tickets = $request->input('tickets');
        $event->event_date = $request->input('event_date');

        $event->save();

        return redirect('/events')->with('success','Event Created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event =  Event::find($id);
        return view('events.show')->with('event',$event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event =  Event::find($id);
        //check for user id
        if(auth()->user()->id == $event->organizer_id || auth()->user()->privilege == 'admin'){
            return view('events.edit')->with('event',$event);   
        }
        return redirect('/events')->with('error',"Unauthorized User");
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
        $this->validate($request, [
            'title'=>'required',
            'description'=>'required',
            'cover_image'=> 'image|nullable|max:10000'
        ]);
        
        //handle file upload
        $filenameToStore = "placeholder-image.png";
        if($request->hasFile('cover_image')){
            //Get file name with extentsion
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $filenameToStore = $filename."_".time().".".$extension; // making the filename unique to prevent image overwriting

            //Upload image
            $path = $request->file('cover_image')->storeAs('public/event_images',$filenameToStore);

        }

        //update event
        $event = Event::find($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->cover_image = $filenameToStore;
        $event->event_date = $request->input('event_date');
        $event->save();

        return redirect('/events')->with('success','Event Updated');
    }

    //view registeration pdf
    public function viewRegister($id){
        // PDF::SetTitle('Hello World');
        // PDF::AddPage();
        // PDF::Write(0, 'Hello World');
        // PDF::Output('hello_world.pdf');
        $event = Event::find($id);
        $eventRegister = EventRegister::where('event_id',$id)->get();
        Fpdf::AddPage('P','A4',0);
        Fpdf::SetFont('Times','B','24');
        $testStr = iconv('windows-1252', 'UTF-8', $event->title);
        Fpdf::Cell(0,20,$testStr.' Registeration',0,1,'C');
        Fpdf::SetFont('Times','B',18);
        Fpdf::Cell(25,10,'User ID',1,0,'C');
        Fpdf::Cell(60,10,'Username',1,0,'C');
        Fpdf::Cell(25,10,'Tickets',1,0,'C');
        Fpdf::Cell(80,10,'notes',1,0,'C');
        Fpdf::Ln();

        
        foreach($eventRegister as $entry){
            Fpdf::SetFont('Times','',12);
            Fpdf::Cell(25,10,$entry->user_id,1,0,'C');
            Fpdf::Cell(60,10,$entry->username,1,0,'C');
            Fpdf::Cell(25,10,$entry->tickets,1,0,'C');
            if(is_null($entry->notes)){
                Fpdf::MultiCell(80,10,$entry->notes,1);
            }
            else
            Fpdf::MultiCell(80,5,$entry->notes,1);
            
        }

        Fpdf::Output('D',$event->title.'_registeration.pdf');
        Fpdf::Output('storage/event_images/'.$event->title.'_register.pdf','F');
        return redirect('storage/event_images/'.$event->title.'_register.pdf');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $eventRegister = EventRegister::where('event_id',$id);
        //check for user id
        if(auth()->user()->id == $event->organizer_id || auth()->user()->privilege == 'admin'){
            $event->delete();
            $eventRegister->delete();
            return redirect('/events')->with('success','Event Deleted');
        }
        return redirect('/events')->with('error',"Unauthorized User");
        
    }

    public function registerForm($id){
        $event = Event::find($id);
        return view('/events.register')->with('event',$event);   


    }
    public function uploadRegister(Request $request, $id){
        if(1){

        }
        $event = Event::find($id);
        $eventRegister = new EventRegister;
        $eventRegister->user_id = auth()->user()->id;
        $eventRegister->event_id = $event->id;
        $eventRegister->username = auth()->user()->name;
        $eventRegister->notes = $request->input('notes');
        $eventRegister->tickets = $request->input('tickets');

        //check if there are enough tickets
        $availableTickets = $event->tickets - DB::table('event_register')->where('event_id',$event->id)->value('tickets');
        if($event->tickets > 0 && ($availableTickets - $request->input('tickets') >= 0)){
            $eventRegister->save();
            if($request->input('tickets') >= 0)
            return redirect('/events/'.$id)->with('success','You have successfully registered '.$request->input('tickets').' ticket(s)');
        }
        else{
            return redirect('/events/'.$id)->with('error','Error: there are only '.$availableTickets.' tickets available.');
        }
    }

    public function cancelRegisteration($event_id)
    {
        // if event has less than 48h, disable "cancel registeration" option
        $event = Event::find($event_id);
        $eventDate = strtotime($event->event_date); //converts event date to seconds
        $registerationDeadline = $eventDate - (2*86400); //deadline is two days before event date
        $test = strtotime("2010-07-01");
        if(($eventDate - time()) <= (2*86400)){
            // echo "<script>alert($eventDate)</script>";
            return redirect('/events/'.$event_id)->with('error','Error: Cannot cancel registeration 48h before the event. Please contact an organizer');
        }
        else{
            $eventRegister = EventRegister::where('event_id',$event_id)->where('user_id',auth()->user()->id);
            $eventRegister->delete();
            return redirect('/events/'.$event_id)->with('success','Registeration Cancelled');
        }        
    }
}
