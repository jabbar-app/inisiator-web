<?php

namespace App\Http\Controllers;

use App\Models\InvitationRequest;
use Illuminate\Http\Request;

class InvitationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = InvitationRequest::orderBy('created_at', 'desc')->paginate(10);

        return view('invitation_requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invitation_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:invitation_requests,phone|max:15',
            'email' => 'required|email|unique:invitation_requests,email|max:255',
            'sample_article' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('sample_article')) {
            $filePath = $request->file('sample_article')->store('sample_articles', 'public');
            $validatedData['sample_article'] = $filePath;
        }

        InvitationRequest::create($validatedData);

        return redirect()->route('invitation_requests.index')
            ->with('success', 'Invitation request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvitationRequest $invitationRequest)
    {
        return view('invitation_requests.show', compact('invitationRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvitationRequest $invitationRequest)
    {
        return view('invitation_requests.edit', compact('invitationRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvitationRequest $invitationRequest)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $invitationRequest->update($validatedData);

        return redirect()->route('invitation_requests.index')
            ->with('success', 'Invitation request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvitationRequest $invitationRequest)
    {
        $invitationRequest->delete();

        return redirect()->route('invitation_requests.index')
            ->with('success', 'Invitation request deleted successfully!');
    }
}
