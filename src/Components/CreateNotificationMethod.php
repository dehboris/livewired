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

use KodeKeep\NotificationMethods\Http\Requests\StoreNotificationMethodRequest;

class CreateNotificationMethod extends Component
{
    use Concerns\InteractsWithTeam;
    use Concerns\InteractsWithUser;

    public ?string $name = null;

    public ?string $channel = 'discord';

    public ?string $discord_url = null;

    public ?string $mail_address = null;

    public ?string $nexmo_api_key = null;

    public ?string $nexmo_api_secret = null;

    public ?string $nexmo_from = null;

    public ?string $nexmo_to = null;

    public ?string $pushbullet_token = null;

    public ?string $pushover_user = null;

    public ?string $pushover_token = null;

    public ?string $slack_url = null;

    public ?string $webhook_url = null;

    public function createNotificationMethod(): void
    {
        abort_unless($this->user->ownsTeam($this->team), 403);

        $data = $this->validate((new StoreNotificationMethodRequest())->rules());

        $this->team->notificationMethods()->create($data);

        $this->emit('refreshNotificationMethods');
    }
}
