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

use Illuminate\Support\Facades\Event;
use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

class ExportTeamData extends Component
{
    use Concerns\InteractsWithTeam;

    public function exportTeamData(): void
    {
        Event::dispatch(new CreatePersonalDataExportJob($this->team));
    }
}
