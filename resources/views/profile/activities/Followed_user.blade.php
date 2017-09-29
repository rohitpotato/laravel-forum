@component('profile.activities.activity')
    @slot('heading')
        {{ $user->name }} started following
        <a href="{{ URL::asset('/profile') }}/{{ $activity->subject->name  }}">{{ $activity->subject->name }}</a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent