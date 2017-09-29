<div id ="reply-{{ $reply->id }}" class="panel panel-default">
    <div class="panel-heading">
      <div class = "level">  
       <h5 class = "flex"> 
        <a href="{{ URL::asset('/profile') }}/{{ $reply->owner->name }}">
            {{ $reply->owner->name }}
        </a> said {{ $reply->created_at->diffForHumans() }}...
       </h5>
        <div>
        @if(!$reply->isFavorited())
          <form action = "{{ URL::asset('/replies') }}/{{ $reply->id }}/favorites" method = "POST">

            {{ csrf_field() }}

             <button type = "submit" class = "btn 
              btn-success btn-xs"{{  $reply->favorites()->count() }} > {{ str_plural('favorite', $reply->favorites()->count()) }}</button>
          
          </form> 	
      @endif
            @if($reply->isFavorited())
          <form action = "{{ URL::asset('/replies') }}/{{ $reply->id }}/unfavorites" method = "POST">

            {{ csrf_field() }}

             <button type = "submit" class = "btn 
              btn-danger btn-xs">{{  $reply->favorites()->count() }} {{ str_plural('Unfavorite', $reply->favorites()->count()) }}</button>
          
          </form>   
    	@endif
  @if(!$best_answer)
    @can('update', $reply)
      <form action = "{{ route('reply.best', $reply->id) }}" method = "POST">

            {{ csrf_field() }}

             <button type = "submit" class = "btn 
              btn-primary btn-xs">Mark as Best Answer</button>
        </form>
    @endcan   
  @endif   
    		</div>
      
      </div>
    
    </div>  

    <div class="panel-body">
        {{ $reply->body }}
    </div>

    <div class = "panel-footer">
    @can('update', $reply)
      <form action = "{{ route('reply.delete', $reply->id) }}" method = "POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}

          <button type = "submit" class = "btn btn-danger btn-xs">Delete</button> 

      </form>
    @endcan  
      <br>
    @can('update', $reply)
      <a href = "{{ route('reply.edit', $reply->id) }}" class="btn btn-xs btn-default">Edit</a>
    @endcan  
    </div>
</div>  