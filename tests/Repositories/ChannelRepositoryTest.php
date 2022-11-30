<?php namespace Tests\Repositories;

use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ChannelRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ChannelRepository
     */
    protected $channelRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->channelRepo = \App::make(ChannelRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_channel()
    {
        $channel = Channel::factory()->make()->toArray();

        $createdChannel = $this->channelRepo->create($channel);

        $createdChannel = $createdChannel->toArray();
        $this->assertArrayHasKey('id', $createdChannel);
        $this->assertNotNull($createdChannel['id'], 'Created Channel must have id specified');
        $this->assertNotNull(Channel::find($createdChannel['id']), 'Channel with given id must be in DB');
        $this->assertModelData($channel, $createdChannel);
    }

    /**
     * @test read
     */
    public function test_read_channel()
    {
        $channel = Channel::factory()->create();

        $dbChannel = $this->channelRepo->find($channel->id);

        $dbChannel = $dbChannel->toArray();
        $this->assertModelData($channel->toArray(), $dbChannel);
    }

    /**
     * @test update
     */
    public function test_update_channel()
    {
        $channel = Channel::factory()->create();
        $fakeChannel = Channel::factory()->make()->toArray();

        $updatedChannel = $this->channelRepo->update($fakeChannel, $channel->id);

        $this->assertModelData($fakeChannel, $updatedChannel->toArray());
        $dbChannel = $this->channelRepo->find($channel->id);
        $this->assertModelData($fakeChannel, $dbChannel->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_channel()
    {
        $channel = Channel::factory()->create();

        $resp = $this->channelRepo->delete($channel->id);

        $this->assertTrue($resp);
        $this->assertNull(Channel::find($channel->id), 'Channel should not exist in DB');
    }
}
