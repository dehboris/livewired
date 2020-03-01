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

class CreateTeam extends Component
{
    use Concerns\InteractsWithUser;

    public ?string $name = null;

    public $team;

    public function createTeam(): void
    {
        $this->validate([
            'name' => ['required', 'max:255'],
        ]);

        $modelClass = config('teams.models.team');

        $this->team = $modelClass::create([
            'owner_id' => $this->user->id,
            'name'     => $this->name,
        ]);

        $this->team->addMember($this->user, 'owner', ['*']);

        $this->emit('refreshTeams');
    }
}
