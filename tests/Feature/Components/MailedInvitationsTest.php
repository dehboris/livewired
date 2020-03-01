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

use Illuminate\Support\Str;
use KodeKeep\Livewired\Components\MailedInvitations;
use KodeKeep\Livewired\Tests\TestCase;
use KodeKeep\Livewired\Tests\User;
use KodeKeep\Teams\Models\Team;
use Livewire\Livewire;
use Ramsey\Uuid\Uuid;

class MailedInvitationsTest extends TestCase
{
    /** @test */
    public function can_cancel_an_invitation()
    {
        $user = $this->user();
        $team = $this->team();

        $invitationId = $this->createInvitation($team, $user);

        $this->actingAs($user);

        $this->assertDatabaseHas('team_invitations', [
            'id'      => $invitationId,
            'user_id' => $team->id,
        ]);

        $this->actingAs($team->owner);

        Livewire::test(MailedInvitations::class, $team)
            ->call('cancelInvitation', $invitationId);

        $this->assertDatabaseMissing('team_invitations', [
            'id'      => $invitationId,
            'user_id' => $team->id,
        ]);
    }

    protected function createInvitation(Team $team, User $user): int
    {
        return $team->invitations()->create([
            'id'           => Uuid::uuid4(),
            'user_id'      => $user->id,
            'role'         => 'member',
            'permissions'  => [],
            'email'        => $this->faker->email,
            'accept_token' => Str::random(40),
            'reject_token' => Str::random(40),
        ])->id;
    }
}
