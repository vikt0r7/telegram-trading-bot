<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Channel;

class ChannelApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_channel()
    {
        $channel = Channel::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/channels', $channel
        );

        $this->assertApiResponse($channel);
    }

    /**
     * @test
     */
    public function test_read_channel()
    {
        $channel = Channel::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/channels/'.$channel->id
        );

        $this->assertApiResponse($channel->toArray());
    }

    /**
     * @test
     */
    public function test_update_channel()
    {
        $channel = Channel::factory()->create();
        $editedChannel = Channel::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/channels/'.$channel->id,
            $editedChannel
        );

        $this->assertApiResponse($editedChannel);
    }

    /**
     * @test
     */
    public function test_delete_channel()
    {
        $channel = Channel::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/channels/'.$channel->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/channels/'.$channel->id
        );

        $this->response->assertStatus(404);
    }
}
