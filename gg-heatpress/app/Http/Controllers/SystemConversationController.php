<?php

namespace App\Http\Controllers;

use App\Models\SystemConversation;
use Illuminate\Http\Request;

class SystemConversationController extends Controller
{
    /**
     * Display a listing of the system conversations.
     */
    public function index(Request $request) //this class need to be renamed to FeedbackController!!! fix me
    {
        // VARIABLES
        $cat = $request->input('category');

        $categories = SystemConversation::select('category')
        ->distinct()
        ->where('status', '!=', 'done')
        ->orderBy('category', 'asc')
        // ->where('category', $category ?? '')
        ->pluck('category');

        if($cat === 'done'){
            $tickets = SystemConversation::where('status', 'done')
            ->orderBy('position', 'asc')
            ->orderBy('message', 'asc')
            ->paginate(10)
            ->withQueryString();

            $ticketsCount = count($tickets);
        } else if($cat){
            $tickets = SystemConversation::where('status', 'open')
            ->where('category', $cat ?? null)
            ->orderBy('position', 'asc')
            ->orderBy('message', 'asc')
            // ->groupBy('category')
            ->paginate(10)
            ->withQueryString();

            $ticketsCount = count($tickets);
        } else {
            $tickets = SystemConversation::where('status', 'open')
            ->orderBy('position', 'asc')
            ->orderBy('message', 'asc')
            ->paginate(10)
            ->withQueryString();

            $ticketsCount = count($tickets);
        }

        return view('feedbacks.index', compact([
        'tickets',
        'categories',
        'ticketsCount'
        ]));
    }

    /*** Show the form for creating a new system conversation.*/
    public function create()
    {
        return view('system-conversations.create');
    }

    /*** Store a newly created system conversation in storage.*/
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'message' => 'required|string|max:5000',
            'category' => 'nullable|string|max:255',
            'due_date' => 'nullable|date',
            'assigned_to' => 'nullable|string|max:255',
        ]);

        SystemConversation::create($validated);

        \Log::channel('tickets')->info('New feedback submitted', [
            'submitted_by' => auth()->user()->name,
            'subject' => $request->input('message', 'General Feedback'),
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

    public function updatePosition(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|integer|min:0',
        ]);

        $id = SystemConversation::findOrFail($request->input('id'));

        $id->position = $validated['position'];
        $id->save();

        return redirect()
            ->route('feedbacks.index')
            ->with('success', 'Position updated successfully.');
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

        //logging
        \Log::channel('tickets')->info('Feedback marked as done', [
            'feedback_id' => $feedback->id,
            'marked_by' => auth()->user()->name,
        ]);

        return redirect()
            ->route('feedbacks.index')
            ->with('success', 'Feedback marked as done successfully.');
    }
}
