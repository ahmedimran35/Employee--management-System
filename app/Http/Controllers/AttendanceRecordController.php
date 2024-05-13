<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use Carbon\Carbon;


class AttendanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function pending_approvals()
    {
        //$attendanceData = AttendanceRecord::all(); // Fetch all data from the database
        //dd($attendanceData);
        $userData= AttendanceRecord::with('user')->get();
        //dd($userData);
        return view('pages.pendingApprovals', compact('userData'));
    }




    public function approve($id)
    {

    $attendance = AttendanceRecord::find($id);
    $attendance->status ='1';
    $attendance->save();

    return redirect()->back();
    }

public function reject($id)
{
    $attendance = AttendanceRecord::find($id);
    $attendance->status ='2';
    $attendance->save();

    return redirect()->back();
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $attendanceRecord = new AttendanceRecord();
        $attendanceRecord->user_id = $request->input('user_id');
        $attendanceRecord->date = $request->input('date');
        $attendanceRecord->entryTime = $request->input('entryTime');
        $attendanceRecord->exitTime = $request->input('exitTime');
        $attendanceRecord->remarks = $request->input('remarks');
        //dd($attendanceRecord);
        $attendanceRecord->save();
       
        return redirect()->back();
           
    }
       
    

    /**
     * Display the specified resource.
     */
    public function showAttendanceForm()
    {

    $currentMonth = Carbon::now()->startOfMonth();
    $dates = [];
    while ($currentMonth->month == Carbon::now()->month) {
        $dates[] = $currentMonth->toDateString();
        $currentMonth->addDay();
    }
  
    return view('pages.attendanceManagement', compact('dates'));
    
    }

   

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
