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

namespace KodeKeep\Livewired\Feature\Components;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use KodeKeep\Livewired\Components\ExportProfileData;
use KodeKeep\Livewired\Tests\TestCase;
use Livewire\Livewire;
use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

class ExportProfileDataTest extends TestCase
{
    /** @test */
    public function it_can_export_the_profile_data()
    {
        Route::personalDataExports('personal-data-exports');

        Event::fake();

        $this->actingAs($this->user());

        Livewire::test(ExportProfileData::class)->call('exportProfileData');

        Event::assertDispatched(CreatePersonalDataExportJob::class);
    }
}
