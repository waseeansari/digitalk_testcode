<?php

namespace Tests\Unit;

use Tests\TestCase;
use DTApi\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use DTApi\Repository\BookingRepository;

class BookingControllerTest extends TestCase
{
    /** @test */
    public function it_fetches_all_users_jobs_when_user_id_is_given()
    {
        $bookingRepository = $this->getMockBuilder(BookingRepository::class)->disableOriginalConstructor()->getMock();
        $bookingRepository->method('getUsersJobs')->willReturn(['user_jobs']); // Mock repository method

        $controller = new BookingController($bookingRepository);

        $request = Request::create('/index', 'GET', ['user_id' => 1]);
        $response = $controller->index($request);

        $this->assertEquals('user_jobs', $response->getContent());
    }

    /** @test */
    public function it_returns_all_jobs_for_admin_or_superadmin()
    {
        $bookingRepository = $this->getMockBuilder(BookingRepository::class)->disableOriginalConstructor()->getMock();
        $bookingRepository->method('getAll')->willReturn(['all_jobs']); // Mock repository method

        $controller = new BookingController($bookingRepository);

        $request = Request::create('/index', 'GET', []);
        $response = $controller->index($request);

        $this->assertEquals('all_jobs', $response->getContent());
    }

    // Write similar tests for other methods in the BookingController
}
