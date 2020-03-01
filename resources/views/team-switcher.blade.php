<div>
    @if ($this->user->hasTeams() && $this->teams->count() > 1)
        @foreach($this->teams as $team)
            @if($this->user->currentTeam->id === $team->id)
                <span>{{ $team->name }}</span>
            @else
                {{ $team->name }}
            @endif
        @endforeach
    @endif
</div>
