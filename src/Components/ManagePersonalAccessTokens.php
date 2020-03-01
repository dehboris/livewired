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

use Illuminate\Support\Collection;

class ManagePersonalAccessTokens extends Component
{
    use Concerns\InteractsWithUser;

    protected $listeners = [
        'refreshPersonalAccessTokens' => '$refresh',
    ];

    public function deletePersonalAccessToken(string $id): void
    {
        $this->user->tokens()->findOrFail($id)->delete();

        $this->emit('refreshPersonalAccessTokens');
    }

    public function getTokensProperty(): Collection
    {
        return $this->user->tokens;
    }
}
