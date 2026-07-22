# Flux PHP SDK for RunAPI

[![Packagist](https://img.shields.io/packagist/v/runapi-ai/flux)](https://packagist.org/packages/runapi-ai/flux)
[![License](https://img.shields.io/github/license/runapi-ai/flux-php)](https://github.com/runapi-ai/flux-php/blob/main/LICENSE)

The Flux PHP SDK is the language-specific package for Flux
on RunAPI. Use this package when your application needs Composer installs,
associative-array request bodies, task status lookup, and consistent RunAPI
errors in PHP.

This README is the PHP package guide for the public `flux-php` split
repository. For model details, use https://runapi.ai/models/flux; for API
reference, use https://runapi.ai/docs#flux; for SDK docs, use
https://runapi.ai/docs#sdk-flux.

## Install

```bash
composer require runapi-ai/flux
```

## Quick start

```php
<?php

require __DIR__ . "/vendor/autoload.php";

use RunApi\Flux\FluxClient;

$client = new FluxClient(); // reads RUNAPI_API_KEY

$task = $client->textToImage->create([
    'model' => 'flux-2-klein',
    'aspect_ratio' => '1:1',
    'output_count' => 1,
    'prompt' => 'A precise product render on white marble',
]);

$status = $client->textToImage->get($task->id);

$remix = $client->remixImage->create([
    'model' => 'flux-pro',
    'prompt' => 'Turn this product shot into a warm editorial photo',
    'source_image_url' => 'https://cdn.runapi.ai/public/samples/image.jpg',
    'aspect_ratio' => '1:1',
    'output_count' => 1,
]);

$result = $client->textToImage->run([
    'model' => 'flux-2-klein',
    'aspect_ratio' => '1:1',
    'output_count' => 1,
    'prompt' => 'A serene mountain lake at dawn',
]);

echo $result->images[0]->url . PHP_EOL;
```

Use `create()` to submit a task and return quickly, `get()` to fetch the latest
task state, and `run()` when a script should create and poll until completion.
In web request handlers, prefer `create()` plus webhook or later `get()`
polling so a worker is not held open.

RunAPI-generated file URLs are temporary. Download and store generated files
in your own durable storage within the retention window; do not treat returned
URLs as long-term assets.

## Language notes

Pass request parameters as associative arrays with snake_case keys. The
available resources are `textToImage`, `remixImage`. Keep `RUNAPI_API_KEY` in the environment
or your secret manager; never commit API keys or callback secrets.

## Links

- Model page: https://runapi.ai/models/flux
- SDK docs: https://runapi.ai/docs#sdk-flux
- Product docs: https://runapi.ai/docs#flux
- Pricing and rate limits: https://runapi.ai/models/flux/dev
- Full catalog: https://runapi.ai/models
- GitHub repository: https://github.com/runapi-ai/flux-php
- Multi-language SDK repository: https://github.com/runapi-ai/flux-sdk

## License

Licensed under the Apache License, Version 2.0.
