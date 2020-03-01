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

use Illuminate\Foundation\Auth\User as BaseUser;
use KodeKeep\Addresses\Concerns\HasAddresses;
use KodeKeep\NotificationMethods\Concerns\HasNotificationMethods;
use KodeKeep\Teams\Concerns\HasTeams;
use Laravel\Airlock\HasApiTokens;

class User extends BaseUser
{
    use HasAddresses;
    use HasApiTokens;
    use HasNotificationMethods;
    use HasTeams;
}
