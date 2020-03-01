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

use KodeKeep\NotificationMethods\Http\Requests\UpdateNotificationMethodRequest;
use KodeKeep\NotificationMethods\Models\NotificationMethod;

class UpdateNotificationMethod extends CreateNotificationMethod
{
    public ?int $notificationMethodId = null;

    protected $listeners = [
        'refreshTwoFactorAuth' => 'refreshTwoFactorAuth',
    ];

    public function editNotificationMethod(int $notificationMethodId): void
    {
        $this->notificationMethodId = $notificationMethodId;

        $this->fill($this->getNotificationMethod());
    }

    public function updateNotificationMethod(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $data = $this->validate((new UpdateNotificationMethodRequest())->rules());

        $this->getNotificationMethod()->update($data);

        $this->emit('refreshNotificationMethods');
    }

    private function getNotificationMethod(): NotificationMethod
    {
        return $this->team->notificationMethods()->findOrFail($this->notificationMethodId);
    }
}
