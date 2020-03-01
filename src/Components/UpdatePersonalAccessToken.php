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

use Laravel\Airlock\PersonalAccessToken;

class UpdatePersonalAccessToken extends Component
{
    use Concerns\InteractsWithUser;

    public $token;

    public ?string $name = null;

    public function mount(PersonalAccessToken $token): void
    {
        $this->token = $token;

        $this->fill($this->token);
    }

    public function updatePersonalAccessToken(): void
    {
        $this->validate(['name' => ['required', 'max:255']]);

        $this->token->update(['name' => $this->name]);

        $this->emit('refreshPersonalAccessTokens');
    }
}
