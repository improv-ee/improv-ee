<?php

namespace Tests\Feature\Api\Organization;

use App\Events\Organization\UserJoined;
use App\Orm\Organization;
use App\Orm\OrganizationUser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Api\ApiTestCase;

class MembershipTest extends ApiTestCase
{
    use DatabaseMigrations;


    public function testOrganizationMemberCanBeAdded()
    {
        $user = $this->actingAsLoggedInUser();

        $organization = factory(Organization::class)->create();

        $response = $this->post(
            sprintf('/api/organizations/%s/membership', $organization->slug),
            [
                'username' => $user->username,
            ]
        );

        $response->assertStatus(201);

        $this->assertDatabaseHas('organization_user', [
            'user_id' => $user->id,
            'organization_id' => $organization->id,
            'role' => OrganizationUser::ROLE_MEMBER]);
    }


    public function testShowReturnsMembershipInfo()
    {
        $user = $this->actingAsOrganizationMember();
        $org = $user->organizations()->first();
        $response = $this->get('/api/organizations/' . $org->slug . '/membership/' . $user->username);


        $response->assertStatus(200)
            ->assertJson(['data' => [
                'organization' => [
                    'name' => $org->name
                ]
            ]]);

    }

    public function testCanNotJoinOrganizationTwice()
    {
        $user = $this->actingAsOrganizationMember();
        $org = $user->organizations()->first();

        $this->assertDatabaseHas('organization_user', ['user_id' => $user->id, 'organization_id' => $org->id]);

        $response = $this->post(sprintf('/api/organizations/%s/membership', $org->slug), ['username' => $user->username]);

        $response->assertStatus(400)
            ->assertJsonStructure(['errors' => []]);
    }


    public function testEventIsCreatedOnOrganizationJoin()
    {
        $user = $this->actingAsLoggedInUser();

        $organization = factory(Organization::class)->create();

        Event::fake();

        $this->post(sprintf('/api/organizations/%s/membership', $organization->slug), ['username' => $user->username]);

        Event::assertDispatched(UserJoined::class, function ($e) use ($organization) {
            return $e->organizationUser->organization_id === $organization->id;
        });
    }
}