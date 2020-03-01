<?php

declare(strict_types=1);

/*
 * This file is part of kodekeep/livewired.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Livewired\Components;

class MailedInvitations extends Component
{
    use Concerns\InteractsWithTeam;
    use Concerns\InteractsWithUser;

    public ?string $invitationId = null;

    protected $listeners = [
        'refreshTeamMembers' => '$refresh',
    ];

    public function cancelInvitation(string $invitationId): void
    {
        $this->invitationId = $invitationId;

        $modelClass = config('teams.models.invitation');

        $invitation = $modelClass::findOrFail($this->invitationId);

        abort_unless($this->user->ownsTeam($invitation->team), 403);

        $invitation->delete();

        $this->emit('refreshTeamMembers');
    }
}
