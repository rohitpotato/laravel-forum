@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
             @forelse ($threads as $thread)
                <div class="panel panel-default">
                   <div class="panel-heading">
                        
                     <div class="level">
                           <h4 class="flex">                      <a href="{{ route('thread.show', $thread->id) }}">
                                {{ $thread->title }}
                                </a>
                           </h4>

                         <a href="{{ route('thread.show', $thread->id) }}">
                           {{ $thread->replies->count() }} Replies
                             </a>
                          </div>             
                      </div>

                    <div class="panel-body">
                      <div class="body">{{ $thread->body }}</div>
                            <hr>
                       
                    </div>
                </div>
             @empty
              <p>There are no threads in this channel at this time</p>  
            @endforelse
            </div>
        </div>
    </div>
@endsection
