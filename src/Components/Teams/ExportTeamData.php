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

namespace KodeKeep\Livewired\Components\Teams;

use KodeKeep\Livewired\Components\Component;
use KodeKeep\Livewired\Components\Concerns\InteractsWithTeam;
use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

class ExportTeamData extends Component
{
    use InteractsWithTeam;

    public function exportTeamData(): void
    {
        dispatch(new CreatePersonalDataExportJob($this->team));
    }
}
