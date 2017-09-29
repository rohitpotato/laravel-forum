<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\User;
use Notification;
use App\Reply;
class RepliesController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
    	$this->validate($request, ['body' => 'required']);

    	$thread->replies()->create(['body' => request('body'), 'user_id' => auth()->id()]);

    		 $watchers = $thread->subscribe()->pluck('user_id');
        	$watcher = User::find($watchers);

    	Notification::send($watcher, new \ App\Notifications\NewReplyAdded($thread));

    	return back();
    }

	public function bestReply(Reply $reply)
	{
		$reply->best_answer = 1;
		$reply->save();
		return back();
	}    

    public function edit(Reply $reply)
    {
            return view('reply.edit', compact('reply'));
    }

    public function upadate(Reply $reply)
    {
        $this->validate(request(), ['body' => 'required']);

        $reply->update(['body' => required('body')]);

        return redirect()->route('thread.show', $reply->thread->id);
    }

    public function delete(Reply $reply)
    {
        $reply->delete();
        return back();
    }
}
