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

use Illuminate\Contracts\Auth\Authenticatable;

class UpdateTeamMember extends Component
{
    use Concerns\InteractsWithTeam;
    use Concerns\InteractsWithUser;

    public $user = null;

    public ?string $name = null;

    public ?string $role = 'member';

    public function mount(Authenticatable $user): void
    {
        $this->user = $user;
    }

    public function updateTeamMember(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $this->validate([
            'role' => ['required', 'in:owner,member'],
        ]);

        $this->team->members()->updateExistingPivot($this->user->id, [
            'role' => $this->role,
        ]);

        $this->reset();

        $this->emit('refreshTeamMembers');
    }
}
