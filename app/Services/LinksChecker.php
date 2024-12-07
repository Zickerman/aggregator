<?php

namespace App\Services;

use App\Models\Link;
use App\Http\Resources\LinkResource;
use App\Jobs\SendToRabbitMQ;


class LinksChecker
{
    public function storeLink(array $data): Link
    {
        if (Link::where('url', $data['url'])->first()) {
            throw new \Exception('URL already exists in the database');
        }

        $link = Link::create([
            'url' => $data['url'],
            'frequency' => $data['frequency'],
            'retries' => $data['retries'],
            'delay' => $data['delay'],
        ]);

        SendToRabbitMQ::dispatch($link->url, $link->frequency, $link->retries, $link->delay);

        return $link;
    }

    public function getLinks()
    {
        return LinkResource::collection(
            Link::orderBy('created_at', 'desc')->get()
        );
    }
}
