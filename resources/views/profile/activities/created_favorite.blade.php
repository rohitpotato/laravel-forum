@component('profile.activities.activity')
    @slot('heading')
        
     	{{  $user->name}} favorited a <a href = "{{ route('thread.show', $activity->subject->favorited->thread->id) }}">reply</a>
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot
@endcomponent
