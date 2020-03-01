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

class UpdateTeamMember extends Component
{
    use Concerns\InteractsWithTeam;
    use Concerns\InteractsWithUser;

    public ?int $userId = null;

    public ?string $role = 'member';

    public $permissions = [];

    protected $listeners = [
        'editTeamMember' => 'editTeamMember',
    ];

    public function editTeamMember(int $userId): void
    {
        $this->userId = $userId;

        $this->fill($this->teamMember);
    }

    public function updateTeamMember(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $this->validate([
            'role' => ['required', 'in:owner,member'],
        ]);

        $this->team->members()->updateExistingPivot($this->teamMember->id, [
            'role' => $this->role,
        ]);

        $this->reset();

        $this->emit('refreshTeamMembers');
    }

    public function getTeamMemberProperty()
    {
        return $this->team->members()->where('user_id', $this->userId)->first();
    }
}
