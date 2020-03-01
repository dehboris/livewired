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

class UpdateExtraBillingInformation extends Component
{
    use Concerns\InteractsWithTeam;
    use Concerns\InteractsWithUser;

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
