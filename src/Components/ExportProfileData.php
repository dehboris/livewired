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

use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

class ExportProfileData extends Component
{
    use Concerns\InteractsWithUser;

    public function exportProfileData(): void
    {
        dispatch(new CreatePersonalDataExportJob($this->user));
    }
}
