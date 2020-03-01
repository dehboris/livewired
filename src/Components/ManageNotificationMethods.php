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

class ManageNotificationMethods extends Component
{
    use Concerns\InteractsWithTeam;

    protected $listeners = [
        'refreshNotificationMethods' => '$refresh',
    ];

    public function deleteNotificationMethod(string $id): void
    {
        $this->team->notificationMethods()->findOrFail($id)->delete();
    }

    public function getNotificationMethodsProperty(): Collection
    {
        return $this->team->notificationMethods;
    }
}
