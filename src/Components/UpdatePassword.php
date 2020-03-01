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

use Illuminate\Support\Facades\Hash;
use KodeKeep\ValidationRules\Rules\CurrentPassword;

class UpdatePassword extends Component
{
    use Concerns\InteractsWithUser;

    public ?string $current_password = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', new CurrentPassword($this->user->password)],
            'password'         => ['required', 'confirmed', 'min:8'],
        ]);

        $this->user->forceFill([
            'password' => Hash::make($this->password),
        ])->save();
    }
}
