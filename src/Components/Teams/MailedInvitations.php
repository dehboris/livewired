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

use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithTeam;
use KodeKeep\Livewired\Components\Concerns\InteractsWithUser;
use KodeKeep\Teams\Models\TeamInvitation;

class MailedInvitations extends Component
{
    use InteractsWithTeam;
    use InteractsWithUser;

    public ?string $invitationId = null;

    protected $listeners = [
        'refreshTeamMembers' => '$refresh',
    ];

    public function cancelInvitation(string $invitationId): void
    {
        $this->invitationId = $invitationId;

        $invitation = TeamInvitation::findOrFail($this->invitationId);

        abort_unless($this->user->ownsTeam($invitation->team), 403);

        $invitation->delete();

        $this->emit('refreshTeamMembers');
    }
}
