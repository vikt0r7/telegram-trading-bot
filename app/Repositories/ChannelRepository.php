<?php

namespace App\Repositories;

use App\Models\Channel;
use App\Repositories\BaseRepository;

/**
 * Class ChannelRepository
 * @package App\Repositories
 * @version November 30, 2022, 1:33 pm UTC
*/

class ChannelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'tag'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Channel::class;
    }
}
