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

use KodeKeep\Livewired\Components\UpdateTeamMember;
use KodeKeep\Livewired\Tests\TestCase;
use KodeKeep\Livewired\Tests\User;
use KodeKeep\Teams\Models\Team;
use Livewire\Livewire;

/**
 * @covers \KodeKeep\Livewired\Components\UpdateTeamMember
 */
class UpdateTeamMemberTest extends TestCase
{
    /** @test */
    public function can_update_the_name()
    {
        [$user, $team] = $this->createModels();

        $this->actingAs($user);

        Livewire::test(UpdateTeamMember::class, $user)
            ->set('role', 'member')
            ->call('updateTeamMember');

        $this->assertSame('member', $team->members->first()->pivot->role);
    }

    private function createModels(): array
    {
        $user = factory(User::class)->create();

        $team = factory(Team::class)->create();
        $team->addMember($user, 'member', []);

        return [$user, $team];
    }
}
