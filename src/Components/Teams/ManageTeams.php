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

class ManageTeams extends Component
{
    use InteractsWithUser;

    protected $listeners = [
        'refreshTeams' => '$refresh',
    ];

    public function switchTeam(string $id): void
    {
        $team = $this->user->teams()->findOrFail($id);

        abort_unless($this->user->onTeam($team), 403);

        $this->user->switchToTeam($team);

        $this->redirect('/');
    }

    public function deleteTeam(string $id): void
    {
        $this->user->teams()->findOrFail($id)->delete();

        $this->reset();

        $this->emit('refreshTeams');
    }
}
