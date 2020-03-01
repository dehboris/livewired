<div>
    @foreach($this->invitations as $invitation)
        {{ $invitation->email }}
    @endforeach
</div>
