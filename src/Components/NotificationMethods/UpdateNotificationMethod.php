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

use KodeKeep\NotificationMethods\Http\Requests\UpdateNotificationMethodRequest;
use KodeKeep\NotificationMethods\Models\NotificationMethod;

class UpdateNotificationMethod extends CreateNotificationMethod
{
    public ?NotificationMethod $notificationMethod = null;

    protected $listeners = ['updateNotificationMethod' => 'edit'];

    public function mount(NotificationMethod $notificationMethod): void
    {
        $this->notificationMethod = $notificationMethod;

        $this->fill($this->notificationMethod);
    }

    public function updateNotificationMethod(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $data = $this->validate(resolve(UpdateNotificationMethodRequest::class)->rules());

        $this->notificationMethod->update($data);

        $this->emit('refreshNotificationMethods');
    }
}
