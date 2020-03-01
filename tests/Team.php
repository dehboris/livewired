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

namespace KodeKeep\Livewired\Tests;

use KodeKeep\Addresses\Concerns\HasAddresses;
use KodeKeep\NotificationMethods\Concerns\HasNotificationMethods;
use KodeKeep\Teams\Models\Team as BaseTeam;

class Team extends BaseTeam
{
    use HasAddresses;
    use HasNotificationMethods;
}
