@extends ('layouts.app')

@section ('content')
 <div class = "container"> 
  
  <div class = "row">
  
    <div class = "col-md-8 col-md-offset-2">

        <div class = "page-header">
              <h1>
            
                {{ $user->name }}'s Activity Log.
              
                <small>Since {{ $user->created_at->diffFOrHumans() }}</small>
            
             </h1>

            
        </div> 

           @foreach($activities as $activity)
                
                 
                  @include ("profile.activities.{$activity->type}")
                  
                 @endforeach
              
        
   </div>  

 </div>
</div>
  
  
@endsection 