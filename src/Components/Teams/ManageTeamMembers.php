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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithTeam;
use KodeKeep\Livewired\Components\Concerns\InteractsWithUser;

class ManageTeamMembers extends Component
{
    use InteractsWithTeam;
    use InteractsWithUser;

    protected $listeners = [
        'refreshTeamMembers' => '$refresh',
    ];

    public function deleteTeamMember(string $id): void
    {
        $member = $this->team->members()->findOrFail($id);

        abort_unless($this->canBeRemoved($member), 403);

        $this->team->stopSharingWith($member);

        $this->reset();

        $this->emit('refreshTeamMembers');
    }

    protected function canBeRemoved(Model $member): bool
    {
        $currentUser = Auth::user();

        if (! $currentUser->ownsTeam($this->team)) {
            return false;
        }

        return $currentUser->id !== $member->id;
    }
}
