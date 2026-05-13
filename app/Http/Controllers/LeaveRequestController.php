<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;  

class LeaveRequestController extends Controller
{
    // show all the requests
    public function index()
    {
        $requests = LeaveRequest::latest()->get();
        return view('leave_requests.index', compact('requests'));
    }

    // store new leaves
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        $validated['status'] = 'Pending';
        LeaveRequest::create($validated);

        return redirect()->route('leave_requests.index')->with('success', 'Leave request submitted successfully.');
    }

    // Approve or Reject request
    public function updateStatus(Request $request, LeaveRequest $leaveRequest)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);
        $leaveRequest->update(['status' => $request->status]);
        return redirect()->route('leave_requests.index')->with('success', 'Leave request updated to ' . $request->status.'.');
    }
}