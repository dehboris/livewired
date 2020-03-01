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

class UpdateProfileInformation extends Component
{
    use Concerns\InteractsWithUser;

    public ?string $name = null;

    public ?string $email = null;

    public function mount(): void
    {
        $this->name  = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfileInformation(): void
    {
        $this->validate([
            'name'  => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email', 'unique:users,email,'.$this->user->id],
        ]);

        $this->user->forceFill([
            'name'  => $this->name,
            'email' => $this->email,
        ])->save();
    }
}
