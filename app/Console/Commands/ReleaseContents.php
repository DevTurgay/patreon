<?php

namespace App\Console\Commands;

use App\Events\ContentReleased;
use App\Models\Content;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ReleaseContents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:release-contents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is being used to release the previously scheduled contents';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contents = Content::where('is_released', 0)
            ->with('user')
            ->where('release_date', '<=', now())->get();

        $contentIds = $contents->pluck('id')->toArray();
        if (empty($contentIds)) {
            Log::debug('Nothing to release.');
            return;
        }

        Log::debug('Contents with following ids will be released: ' . implode(',', $contents->pluck('id')->toArray()));

        Content::whereIn('id', $contentIds)->update(['is_released' => 1]);

        foreach ($contents as $content) {
            $message = [
                'message' => $content->user->name . " posted a new content!",
                'contentId' => $content->id,
                'userId' => $content->user_id
            ];
            event(new ContentReleased($message));
        }

        Cache::forget('contents');
    }
}
