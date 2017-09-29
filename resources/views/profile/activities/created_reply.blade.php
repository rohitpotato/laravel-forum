@component('profile.activities.activity')
    @slot('heading')
        {{ $user->name }} replied to
        <a href="{{ route('thread.show', $activity->subject->thread->id) }}">"{{ $activity->subject->thread->title }}"</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
