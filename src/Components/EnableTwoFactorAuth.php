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

use Illuminate\Support\Str;
use PragmaRX\Google2FALaravel\Facade as Google2FA;

class EnableTwoFactorAuth extends Component
{
    use Concerns\InteractsWithUser;

    public ?string $secret = null;

    public ?int $otp = null;

    public ?string $resetCode = null;

    public ?string $qrcode = null;

    protected $listeners = [
        'refreshTwoFactorAuth' => '$refresh',
    ];

    public function enableTwoFactorAuth(): void
    {
        $this->user->forceFill([
            'uses_two_factor_auth'  => true,
            'two_factor_secret'     => encrypt(Google2FA::generateSecretKey()),
            'two_factor_reset_code' => bcrypt($this->resetCode = Str::random(64)),
        ])->save();

        $this->emit('refreshTwoFactorAuth');
    }
}
