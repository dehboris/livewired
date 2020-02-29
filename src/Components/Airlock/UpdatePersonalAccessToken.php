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

namespace KodeKeep\Livewired\Components\Airlock;

use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithUser;
use Laravel\Airlock\PersonalAccessToken;

class UpdatePersonalAccessToken extends Component
{
    use InteractsWithUser;

    public ?PersonalAccessToken $token = null;

    public function mount(PersonalAccessToken $token): void
    {
        $this->token = $token;
    }

    public function updatePersonalAccessToken(): void
    {
        $this->validate(['name' => ['required', 'max:255']]);

        $this->token->update(['name' => $this->name]);

        $this->emit('refreshPersonalTokens');
    }

    public function getTokenProperty(): ?PersonalAccessToken
    {
        return $this->user->tokens()->find($this->tokenId);
    }
}
