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
use KodeKeep\Teams\Models\Team;

class CreateTeam extends Component
{
    use InteractsWithUser;

    public ?string $name = null;

    public ?Team $team = null;

    public function createTeam(): void
    {
        $this->validate([
            'name' => ['required', 'max:255'],
        ]);

        $this->team = Team::create([
            'owner_id' => $this->user->id,
            'name'     => $this->name,
        ]);

        $this->emit('refreshTeams');
    }
}
