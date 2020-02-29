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
use KodeKeep\Livewired\Components\Concerns\InteractsWithUser;
use KodeKeep\Teams\Contracts\Team;

class LeaveTeam extends Component
{
    use InteractsWithUser;

    public ?Team $team = null;

    protected $listeners = ['leaveTeam' => 'askForConfirmation'];

    public function mount(Team $team): void
    {
        $this->team = $team;
    }

    public function leaveTeam(): void
    {
        $this->team->removeMember($this->user);

        $this->reset();

        $this->emit('refreshTeams');
    }
}
