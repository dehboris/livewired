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

use KodeKeep\Teams\Contracts\TeamInvitation;

class PendingInvitations extends Component
{
    use Concerns\InteractsWithUser;

    public function acceptInvitation(TeamInvitation $invitation)
    {
        abort_unless($this->user->id === $invitation->user_id, 404);

        $invitation->team->addMember($this->user, $invitation->role, $invitation->permissions);

        $invitation->delete();
    }

    public function rejectInvitation(TeamInvitation $invitation)
    {
        abort_unless($this->user->id === $invitation->user_id, 404);

        $invitation->delete();
    }
}
