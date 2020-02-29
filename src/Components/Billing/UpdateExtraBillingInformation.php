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

namespace KodeKeep\Livewired\Components\Billing;

use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithTeam;
use KodeKeep\Livewired\Components\Concerns\InteractsWithUser;

class UpdateExtraBillingInformation extends Component
{
    use InteractsWithTeam;
    use InteractsWithUser;

    public ?string $extra_billing_information = null;

    public function mount(): void
    {
        $this->fill($this->team);
    }

    public function updateExtraBillingInformation(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $this->validate([
            'extra_billing_information' => ['nullable', 'string', 'max:2048'],
        ]);

        $this->team->forceFill([
            'extra_billing_information' => $this->extra_billing_information,
        ])->save();
    }
}
