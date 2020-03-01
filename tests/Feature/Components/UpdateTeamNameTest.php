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

use KodeKeep\Livewired\Components\UpdateTeamName;
use KodeKeep\Livewired\Tests\TestCase;
use Livewire\Livewire;

class UpdateTeamNameTest extends TestCase
{
    /** @test */
    public function can_update_the_team_name()
    {
        $this->actingAs($this->team()->owner);

        Livewire::test(UpdateTeamName::class)
            ->set('name', 'team name')
            ->call('updateTeamName')
            ->assertHasNoErrors('name');
    }

    /** @test */
    public function cant_update_the_name_if_it_is_empty()
    {
        $this->actingAs($this->team()->owner);

        Livewire::test(UpdateTeamName::class)
            ->set('name', null)
            ->call('updateTeamName')
            ->assertHasErrors(['name' => 'required']);
    }

    /** @test */
    public function cant_update_the_name_if_it_is_longer_than_255_characters()
    {
        $this->actingAs($this->team()->owner);

        Livewire::test(UpdateTeamName::class)
            ->set('name', str_repeat('x', 512))
            ->call('updateTeamName')
            ->assertHasErrors(['name' => 'max']);
    }
}
