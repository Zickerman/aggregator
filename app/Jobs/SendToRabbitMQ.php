<?php

namespace App\Jobs;

use App\Models\Link;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\Process\Process;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendToRabbitMQ implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $url,
        protected int $frequency,
        protected int $retries,
        protected int $jobDelay
    ) {}

    public function handle()
    {
        Log::info("Handling job for URL: " . $this->url);

        $link = Link::where('url', $this->url)->first();

        if ($link) {
            $this->checkUrl($link);

            if ($this->retries > 0) {
                $this->retries--;

                SendToRabbitMQ::dispatch($this->url, $this->frequency, $this->retries, $this->jobDelay)
                    ->delay(now()->addMinutes($this->frequency));
            }
        } else {
            Log::info("No URL found for: " . $this->url);
        }
    }

    private function checkUrl(Link $link)
    {
        Log::info("Checking URL: " . $link->url);

        $process = new Process(['curl', '-I', $link->url]);
        $process->run();
        if ($process->isSuccessful()) {
            Log::info("URL is successful: " . $link->url);

            $link->update([
                'status' => 'success' // we can also update: response and http_response fields
            ]);
        } else {
            Log::error("URL check failed: " . $link->url);

            $link->update([
                'status' => 'failed' // we can also update: response and http_response fields
            ]);

            if ($this->jobDelay > 0) {
                SendToRabbitMQ::dispatch($this->url, $this->frequency, $this->retries, $this->jobDelay)
                    ->delay(now()->addMinutes($this->jobDelay));
            }
        }
    }
}
