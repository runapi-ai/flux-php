<?php

declare(strict_types=1);

namespace RunApi\Flux;

use RunApi\Core\BaseClient;
use RunApi\Core\ClientOptions;
use RunApi\Flux\Resources\RemixImage;
use RunApi\Flux\Resources\TextToImage;

/**
 * Flux RunAPI PHP client.
 *
 * The client exposes typed model resources plus the universal `files` and
 * `account` resources.
 */
final class FluxClient extends BaseClient
{
    /** Text to image operations for Flux. */
    public readonly TextToImage $textToImage;
    /** Remix image operations for Flux. */
    public readonly RemixImage $remixImage;

    /** Create a Flux client with optional API key, base URL, and transport overrides. */
    public function __construct(ClientOptions $options = new ClientOptions())
    {
        parent::__construct($options);
        $this->textToImage = TextToImage::fromHttp($this->http);
        $this->remixImage = RemixImage::fromHttp($this->http);
    }
}
