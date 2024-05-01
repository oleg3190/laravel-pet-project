<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeployTest extends TestCase
{

	public function testPloiDeploy(): void
	{

		$response = $this->get('/book');

		$response->assertStatus(500);
	}

}