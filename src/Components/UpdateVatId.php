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

use KodeKeep\ValidationRules\Rules\VatId;

class UpdateVatId extends Component
{
    use Concerns\InteractsWithTeam;
    use Concerns\InteractsWithUser;

    public ?string $vat_id = null;

    public function mount(): void
    {
        $this->fill($this->team);
    }

    public function updateVatId(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $this->validate([
            'vat_id' => ['nullable', 'max:50', new VatId()],
        ]);

        $this->team->forceFill(['vat_id' => $this->vat_id])->save();
    }
}
