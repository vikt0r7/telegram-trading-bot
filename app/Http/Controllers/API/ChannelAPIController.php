<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateChannelAPIRequest;
use App\Http\Requests\API\UpdateChannelAPIRequest;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ChannelController
 * @package App\Http\Controllers\API
 */

class ChannelAPIController extends AppBaseController
{
    /** @var  ChannelRepository */
    private $channelRepository;

    public function __construct(ChannelRepository $channelRepo)
    {
        $this->channelRepository = $channelRepo;
    }

    /**
     * Display a listing of the Channel.
     * GET|HEAD /channels
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $channels = $this->channelRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($channels->toArray(), 'Channels retrieved successfully');
    }

    /**
     * Store a newly created Channel in storage.
     * POST /channels
     *
     * @param CreateChannelAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateChannelAPIRequest $request)
    {
        $input = $request->all();

        $channel = $this->channelRepository->create($input);

        return $this->sendResponse($channel->toArray(), 'Channel saved successfully');
    }

    /**
     * Display the specified Channel.
     * GET|HEAD /channels/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Channel $channel */
        $channel = $this->channelRepository->find($id);

        if (empty($channel)) {
            return $this->sendError('Channel not found');
        }

        return $this->sendResponse($channel->toArray(), 'Channel retrieved successfully');
    }

    /**
     * Update the specified Channel in storage.
     * PUT/PATCH /channels/{id}
     *
     * @param int $id
     * @param UpdateChannelAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChannelAPIRequest $request)
    {
        $input = $request->all();

        /** @var Channel $channel */
        $channel = $this->channelRepository->find($id);

        if (empty($channel)) {
            return $this->sendError('Channel not found');
        }

        $channel = $this->channelRepository->update($input, $id);

        return $this->sendResponse($channel->toArray(), 'Channel updated successfully');
    }

    /**
     * Remove the specified Channel from storage.
     * DELETE /channels/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Channel $channel */
        $channel = $this->channelRepository->find($id);

        if (empty($channel)) {
            return $this->sendError('Channel not found');
        }

        $channel->delete();

        return $this->sendSuccess('Channel deleted successfully');
    }
}
