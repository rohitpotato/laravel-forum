@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class = "level">
                        <span class = "flex">
                            <a href="{{ URL::asset('/profile') }}/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
                            {{ $thread->title }}
                        </span>
                       
                        @can('update', $thread)
                            <form action="{{ route('thread.delete', $thread->id) }}" method = "POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                 <button type = "submit" class = "btn btn-danger btn-xs">Delete</button>
                            </form>
                        @endcan

                       @can('update', $thread)
                            <a href = "{{ route('thread.edit', $thread->id) }}" class = "btn btn-xs btn-default" style="margin-left: 8px">Edit</a>
                        @endcan

                          @if(!$thread->is_subscribed())
                            <form action="{{ route('thread.subscribe', $thread->id) }}" method = "POST">
                                {{ csrf_field() }}
                                 <button type = "submit" class = "btn btn-primary btn-xs" style="margin-left: 8px">subscribe</button>
                            </form>
                        @else
                            <form action="{{ route('thread.unsubscribe', $thread->id) }}" method = "POST">
                                {{ csrf_field() }}
                                 <button type = "submit" class = "btn btn-warning btn-xs" style="margin-left: 8px">Unsubscribe</button>
                            </form>
                        @endif
                      </div>  


                        
                    </div>

                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>

                @if($best_answer)
                <div class="text-center" style="padding: 40px;">
                  <h3 class="text-center">BEST ANSWER</h3>
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      
                      <span>{{ $best_answer->owner->name }} <b>( xp )</b></span>
                  </div>

                  <div class="panel-body">
                      {{ $best_answer->body }}
                  </div>
              </div>
          </div>
          @endif


                @foreach ($thread->replies as $reply)
                    @include ('threads.reply')
                @endforeach

                @if (auth()->check())
                    <form method="POST" action="{{ route('reply.store', $thread->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"
                                      rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Post</button>
                    </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this
                        discussion.</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>, and currently
                            has {{ $thread->replies()->count() }} {{ str_plural('comment', $thread->replies()->count()) }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
