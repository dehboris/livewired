<div>
    @foreach($this->members as $member)
        @if($member->id === $this->user->id)
            You
        @else
            {{ $member->name }}
        @endif
    @endforeach
</div>
