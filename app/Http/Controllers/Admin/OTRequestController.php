<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OTRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OTRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $keyword = $request->get('search');
        $perPage = 5;

        if(auth()->user()->role == "User"){
            if (!empty($keyword)) {
                $otrequest = OTRequest::where('emp_id', '=', auth()->user()->id)
                    ->orWhere('full_name', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $otrequest = OTRequest::where('emp_id', '=', auth()->user()->id)->latest()->paginate($perPage);
            }
        }
        else{
            if (!empty($keyword)) {
                $otrequest = OTRequest::Where('full_name', 'LIKE', "%$keyword%")
                    ->latest()->paginate($perPage);
            } else {
                $otrequest = OTRequest::latest()->paginate($perPage);
            }
        }

        
        return view('admin.request-overtime.index',compact('otrequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.request-overtime.create');
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
            'date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'work_done' => 'required',
            'location' => 'required'
        ]);

        $startTime = Carbon::parse($request->time_from);
        $endTime = Carbon::parse($request->time_to);

        $totalMinutes = $endTime->diffInMinutes($startTime);
        $totalHours = $totalMinutes / 60;
        $requestData = $request->all();

        $requestData = $totalHours;

        $otrequest = new OTRequest();
        //On left field name in DB and on right field name in Form/view/request
        $otrequest->emp_id = auth()->user()->id;
        $otrequest->full_name = auth()->user()->name;
        $otrequest->date = $request->input('date');
        $otrequest->time_from = $request->input('time_from');
        $otrequest->time_to = $request->input('time_to');
        $otrequest->work_done = $request->input('work_done');
        $otrequest->location = $request->input('location');
        $otrequest->hours_request = $totalHours;
        $otrequest->status = 'S';
        $otrequest->save();

        return redirect('admin/request-overtime')->with('flash_message', 'Overtime Request added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OTRequest  $oTRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $otrequest = OTRequest::findOrFail($id);

        return view('admin.request-overtime.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OTRequest  $oTRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $otrequest = OTRequest::findOrFail($id);
        if(auth()->user()->role == "User"){
            return view('admin.request-overtime.edit', compact('otrequest'));
        }
        else{
            return view('admin.request-overtime.ot_approve', compact('otrequest'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OTRequest  $oTRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->role == "User"){
            
            $this->validate($request, [
            'date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'work_done' => 'required',
            'location' => 'required'
        ]);

            $startTime = Carbon::parse($request->time_from);
            $endTime = Carbon::parse($request->time_to);

            $totalMinutes = $endTime->diffInMinutes($startTime);
            $totalHours = $totalMinutes / 60;

            $requestData = $totalHours;

            $otrequest = new OTRequest();
            //On left field name in DB and on right field name in Form/view/request
            $otrequest = OTRequest::findOrFail($id);
            $otrequest->emp_id = auth()->user()->id;
            $otrequest->full_name = auth()->user()->name;
            $otrequest->date = $request->input('date');
            $otrequest->time_from = $request->input('time_from');
            $otrequest->time_to = $request->input('time_to');
            $otrequest->work_done = $request->input('work_done');
            $otrequest->location = $request->input('location');
            $otrequest->hours_request = $totalHours;
            $otrequest->save();
        }
        else{

            $this->validate($request, [
            'hours_approve' => 'required'
        ]);
            $otrequest = new OTRequest();
            $otrequest = OTRequest::findOrFail($id);
            $otrequest->hours_approve = $request->input('hours_approve');        
            $otrequest->save(); 
        }

        return redirect('admin/request-overtime')->with('flash_message', 'Request Overtime updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OTRequest  $oTRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OTRequest::destroy($id);
        return redirect('admin/request-overtime')->with('flash_message', 'Request Overtime deleted!');
    }

    public function reviewed($id)
    {
        OTRequest::destroy($id);
        return redirect('admin/request-overtime')->with('flash_message', 'Request Overtime Reviewed!');
    }
}
