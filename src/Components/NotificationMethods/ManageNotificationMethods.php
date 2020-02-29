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

namespace KodeKeep\Livewired\Components\NotificationMethods;

use Illuminate\Support\Collection;
use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithTeam;

class ManageNotificationMethods extends Component
{
    use InteractsWithTeam;

    protected $listeners = [
        'refreshNotificationMethods' => '$refresh',
    ];

    public function destroyNotificationMethod(string $id): void
    {
        $this->team->notificationMethods()->findOrFail($id)->delete();
    }

    public function getNotificationMethodsProperty(): Collection
    {
        return $this->team->notificationMethods;
    }
}
