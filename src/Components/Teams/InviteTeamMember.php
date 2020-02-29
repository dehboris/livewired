<?php

declare(strict_types=1);

/*
 * This file is part of Livewired.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Livewired\Components\Teams;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithTeam;
use KodeKeep\Teams\Contracts\Team;
use KodeKeep\Teams\Contracts\TeamInvitation;
use Ramsey\Uuid\Uuid;

class InviteTeamMember extends Component
{
    use InteractsWithTeam;

    public ?string $email = null;

    public ?string $role = 'member';

    public function inviteTeamMember(): void
    {
        $this->validate([
            'email' => ['required', 'email', 'max:255'],
            'role'  => ['required', 'string', 'in:owner,member'],
        ]);

        if ($this->emailAlreadyOnTeam($this->team)) {
            $this->whenEmailAlreadyOnTeam();

            return;
        }

        if ($this->emailAlreadyInvited($this->team)) {
            $this->whenEmailAlreadyInvited();

            return;
        }

        $userClass = config('auth.providers.users.model');

        $invitedUser = $userClass::where('email', $this->email)->first();

        $invitation = $this->createInvitation($invitedUser);

        if ($invitation->user_id) {
            $this->inviteExistingUser($invitation);
        } else {
            $this->inviteNewUser($invitation);
        }

        $this->reset();

        $this->emit('refreshTeamMembers');
    }

    protected function whenEmailAlreadyOnTeam(): void
    {
        //
    }

    protected function whenEmailAlreadyInvited(): void
    {
        //
    }

    protected function inviteExistingUser(TeamInvitation $invitation): void
    {
        //
    }

    protected function inviteNewUser(TeamInvitation $invitation): void
    {
        //
    }

    protected function emailAlreadyOnTeam(Team $team): bool
    {
        return $team->members()->where('email', $this->email)->exists();
    }

    protected function emailAlreadyInvited(Team $team): bool
    {
        return $team->invitations()->where('email', $this->email)->exists();
    }

    protected function createInvitation(?Authenticatable $invitedUser)
    {
        return $this->team->invitations()->create([
            'id'      => Uuid::uuid4(),
            'user_id' => $invitedUser ? $invitedUser->id : null,
            'role'    => $this->role,
            'email'   => $this->email,
            'token'   => Str::random(40),
        ]);
    }
}
