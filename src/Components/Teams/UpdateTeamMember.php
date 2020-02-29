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

use Illuminate\Foundation\Auth\User;
use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithTeam;
use KodeKeep\Livewired\Components\Concerns\InteractsWithUser;

class UpdateTeamMember extends Component
{
    use InteractsWithTeam;
    use InteractsWithUser;

    public ?User $user = null;

    public ?string $name = null;

    public ?string $role = 'member';

    protected $listeners = ['updateTeamMember' => 'edit'];

    public function mount(User $user): void
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
