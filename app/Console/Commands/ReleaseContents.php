<?php

namespace App\Console\Commands;

use App\Models\Content;
use Illuminate\Console\Command;
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
            ->where('release_date', '<=', now())
            ->pluck('id')->toArray();

        Log::debug('Contents with following ids will be released: ' . implode(',', $contents));

        Content::whereIn('id', $contents)->update(['is_released' => 1]);
    }
}
