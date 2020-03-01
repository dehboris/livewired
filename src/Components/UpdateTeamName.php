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

class UpdateTeamName extends Component
{
    use Concerns\InteractsWithTeam;
    use Concerns\InteractsWithUser;

    public ?string $name = null;

    public function mount(): void
    {
        $this->name = $this->team->name;
    }

    public function updateTeamName(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $this->validate(['name' => ['required', 'max:255']]);

        $this->team->forceFill(['name' => $this->name])->save();
    }
}
