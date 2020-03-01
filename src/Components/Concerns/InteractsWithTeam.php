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

namespace KodeKeep\Livewired\Components\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use KodeKeep\Teams\Contracts\Team;

trait InteractsWithTeam
{
    public function getTeamProperty(): Team
    {
        return Auth::user()->currentTeam();
    }

    public function getMembersProperty(): Collection
    {
        return $this->team->members;
    }

    public function getInvitationsProperty(): Collection
    {
        return $this->team->invitations;
    }
}
