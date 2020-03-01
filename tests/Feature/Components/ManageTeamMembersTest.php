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

use KodeKeep\Livewired\Components\ManageTeamMembers;
use KodeKeep\Livewired\Tests\TestCase;
use KodeKeep\Livewired\Tests\User;
use Livewire\Livewire;

/**
 * @covers \KodeKeep\Livewired\Components\ManageTeamMembers
 */
class ManageTeamMembersTest extends TestCase
{
    /** @test */
    public function can_list_the_team_members()
    {
        $team = $this->team();

        $this->actingAs($team->owner);

        $team->addMember($member = factory(User::class)->create(), 'member', []);

        Livewire::test(ManageTeamMembers::class, $team)
            ->assertSee('You')
            ->assertSee($member->name);
    }

    /** @test */
    public function can_destroy_the_team_if_it_is_the_owner()
    {
        $team = $this->team();

        $this->actingAs($team->owner);

        $anotherUser = $this->user();
        $team->addMember($anotherUser, 'member', []);

        $this->assertDatabaseHas('team_users', [
            'team_id'         => $team->id,
            'user_id'         => $anotherUser->id,
            'role'            => 'member',
        ]);

        Livewire::test(ManageTeamMembers::class)
            ->call('deleteTeamMember', $anotherUser->id);

        $this->assertDatabaseMissing('team_users', [
            'team_id'         => $team->id,
            'user_id'         => $anotherUser->id,
            'role'            => 'member',
        ]);
    }
}
