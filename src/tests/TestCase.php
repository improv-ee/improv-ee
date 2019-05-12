<?php

namespace Tests;

use App\Orm\Organization;
use App\Orm\OrganizationUser;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function getWebUrl()
    {
        return '';
    }

    protected function setUp() : void
    {
        parent::setUp();

        if (!file_exists(Passport::keyPath('oauth-private.key'))) {
            Artisan::call('passport:install');
        }
        Storage::fake('media');
    }


    /**
     * @param int $role
     * @return \Illuminate\Contracts\Auth\Authenticatable|User
     */
    protected function actingAsOrganizationMember(int $role = OrganizationUser::ROLE_MEMBER)
    {
        $user = $this->actingAsLoggedInUser();
        $organization = factory(Organization::class)->create();
        $organization->users()->attach($user, ['role' => $role, 'creator_id' => $user->id]);
        return Passport::actingAs($user);
    }


    protected function actingAsLoggedInUser()
    {
        $user = factory(User::class)->create();

        $user->assignRole('standard-user');
        return Passport::actingAs($user);
    }

    protected function actingAsUnauthenticatedUser()
    {
        $user = factory(User::class)->create();

        return Passport::actingAs($user);
    }
}
