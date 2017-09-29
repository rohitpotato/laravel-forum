@component('profile.activities.activity')
    @slot('heading')
        {{ $user->name }} published
        <a href="{{ route('thread.show',$activity->subject->id) }}">{{ $activity->subject->title }}</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent