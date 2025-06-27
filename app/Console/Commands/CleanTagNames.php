<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanTagNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-tag-names';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
    \App\Models\Tag::withTrashed()->chunk(100, function ($tags) {
        foreach ($tags as $tag) {
            $cleanName = trim(preg_replace('/\s+/', ' ', $tag->name));
            if ($tag->name !== $cleanName) {
                $tag->name = $cleanName;
                $tag->save();
            }
        }
    });

    $this->info('All tag names have been cleaned.');
}

}
