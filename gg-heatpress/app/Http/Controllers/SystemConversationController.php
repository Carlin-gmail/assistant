<?php

namespace App\Http\Controllers;

use App\Models\SystemConversation;
use Illuminate\Http\Request;

class SystemConversationController extends Controller
{
    /**
     * Display a listing of the system conversations.
     */
    public function index() //this class need to be renamed to FeedbackController!!! fix me
    {
        $tickets = SystemConversation::where('status', 'open')
        ->paginate(5)
        ->withQueryString();
        return view('feedbacks.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new system conversation.
     */
    public function create()
    {
        return view('system-conversations.create');
    }

    /**
     * Store a newly created system conversation in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'feedback' => 'required|string|max:5000',
        ]);

        SystemConversation::create([
            'message' => $validated['feedback'],
            'message_from' => auth()->user()->name,
            'status' => 'open',
            //get the url of this page
            'page_url' => url()->previous(),
            'subject' => $request->input('subject', 'General Feedback'),
            'priority' => $request->input('priority', 'normal'),
            'distak' => $request->input('distak', ''),
        ]);

        return redirect()
            ->route('feedbacks.index')
            ->with('success', 'Conversation created successfully.');
    }

    /**
     * Display the specified system conversation.
     */
    public function show(SystemConversation $systemConversation)
    {
        return view('system-conversations.show', compact('systemConversation'));
    }

    /**
     * Show the form for editing the specified system conversation.
     */
    public function edit(SystemConversation $systemConversation)
    {
        return view('system-conversations.edit', compact('systemConversation'));
    }

    /**
     * Update the specified system conversation in storage.
     */
    public function update(Request $request, SystemConversation $systemConversation)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $systemConversation->update($validated);

        return redirect()
            ->route('system-conversations.index')
            ->with('success', 'Conversation updated successfully.');
    }

    /**
     * Remove the specified system conversation from storage.
     */
    public function destroy(SystemConversation $systemConversation)
    {
        $systemConversation->delete();

        return redirect()
            ->route('system-conversations.index')
            ->with('success', 'Conversation deleted successfully.');
    }

    public function feedbackDone($feedback)
    {
        $feedback = SystemConversation::findOrFail($feedback);
        $feedback->status = 'done';
        $feedback->save();
        return redirect()
            ->route('feedbacks.index')
            ->with('success', 'Feedback marked as done successfully.');
    }
}
