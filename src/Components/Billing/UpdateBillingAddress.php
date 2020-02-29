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

class UpdateBillingAddress extends Component
{
    use InteractsWithTeam;
    use InteractsWithUser;

    public ?string $name = null;

    public ?string $address_line_1 = null;

    public ?string $address_line_2 = null;

    public ?string $city = null;

    public ?string $state = null;

    public ?string $zip = null;

    public ?string $country = null;

    public function mount(): void
    {
        $this->full($this->team->addresses()->whereType('billing')->firstOrFail());
    }

    public function updateBillingAddress(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $validated = $this->validate([
            'name'           => ['required', 'string', 'max:255'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city'           => ['required', 'string', 'max:255'],
            'state'          => ['required', 'string', 'max:255'],
            'zip'            => ['required', 'string', 'max:25'],
            'country'        => ['required', 'string', 'max:2'],
        ]);

        $this->team->addresses()->updateOrCreate(
            ['type' => 'billing'],
            array_merge($validated, ['type' => 'billing'])
        );
    }
}
