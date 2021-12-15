<?php

declare(strict_types=1);

namespace NowPlaying\Adapter;

use NowPlaying\Result\Client;
use NowPlaying\Result\Result;

interface AdapterInterface
{
    /**
     * Return the current "Now Playing" data for the instance.
     *
     * @param null|string $mount          the mount point or stream ID (SID) to fetch
     * @param bool        $includeClients whether to include client details in the result
     */
    public function getNowPlaying(
        ?string $mount = null,
        bool $includeClients = false
    ): Result;

    /**
     * @return Client[]
     */
    public function getClients(
        ?string $mount = null,
        bool $uniqueOnly = false
    ): array;
}
