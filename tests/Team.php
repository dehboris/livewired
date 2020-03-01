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

use Illuminate\Support\Str;
use KodeKeep\Addresses\Concerns\HasAddresses;
use KodeKeep\NotificationMethods\Concerns\HasNotificationMethods;
use KodeKeep\Teams\Models\Team as BaseTeam;
use Spatie\PersonalDataExport\ExportsPersonalData;
use Spatie\PersonalDataExport\PersonalDataSelection;

class Team extends BaseTeam implements ExportsPersonalData
{
    use HasAddresses;
    use HasNotificationMethods;

    public function selectPersonalData(PersonalDataSelection $personalData): void
    {
        $personalData->add('team.json', ['name' => $this->name, 'email' => $this->email]);
    }

    public function personalDataExportName(): string
    {
        return 'personal-data-'.Str::slug($this->name).'.zip';
    }
}
