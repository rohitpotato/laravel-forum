<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Channel;
use App\User;
class ThreadsController extends Controller
{
    public function create()
    {
    	return view('threads.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, ['channel_id' => 'required', 'title' => 'required', 'body' => 'required']);

    	Thread::create(['channel_id' => request('channel_id'), 'title' => request('title'), 'body' => request('body'), 'user_id' => auth()->id()]);

    	return back();
    }

    public function index(Channel $channel)
    {
        if($channel->exists)
        {
            $threads = Thread::where('channel_id', $channel->id);
        }

       else if($username = request('by'))
        {
            $user = User::where('name', $username)->first();
            $threads = $user->threads();
        }
        else
        {
            $threads = Thread::latest();
        }

        $threads = $threads->get();

    	return view('threads.index', compact('threads'));
    }
    

    public function show(Thread $thread)
    {   
        $best_answer = $thread->replies()->where('best_answer', 1)->first();
    	return view('threads.show', compact('thread', 'best_answer'));
    }

    public function destroy(Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        return redirect('/threads');
    }

    public function edit(Thread $thread)
    {
        return view('threads.edit',compact('thread'));
    }

    public function update(Thread $thread, Request $request)
    {
         $this->authorize('update', $thread);
         
        $this->validate($request, ['channel_id' => 'required', 'title' => 'required', 'body' => 'required']);

        $thread->update(['body' => request('body'), 'channel_id' => request('channel_id'), 'title' => request('title')]);

        return redirect()->route('thread.show', $thread->id);
    }

    public function subscribe(Thread $thread)
    {   
        $thread->subscribe()->create(['user_id' => auth()->id()]);

        return back();
    }

    public function unsubscribe(Thread $thread)
    {
        $thread->subscribe()->where('user_id', auth()->id())->delete();
        return back();
    }
}
