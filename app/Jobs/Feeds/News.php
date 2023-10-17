<?php

namespace App\Jobs\Feeds;

use Carbon\Carbon;
use App\Models\Article;
use App\Models\Ranking;

use App\Http\Controllers\FeedController;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class News implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $log;

    public $tries = 1;
    public $timeout = 600; // Ten minutes

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->log = FeedController::queued('News');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        FeedController::running($this->log, $this->job->payload()['uuid']);

        $response = Http::get(config('espn.news'));
        $articles = $response->json()['articles'];

        foreach ($articles as $a) {

            if (isset($a['links']['api']['news']['href']) && in_array($a['type'], ['Preview', 'HeadlineNews', 'Story'])) {

                if (isset($a['images'])) {
                    if ($a['type'] == 'HeadlineNews' || $a['type'] == 'Story') {
                        $image = $a['images'][0]['url'] ?? null;
                    } else {
                        if (isset($a['images'][6])) {
                            $image = $a['images'][6]['url'] ?? null;
                        } else {
                            $image = $a['images'][0]['url'] ?? null;
                        }
                    }
                }

                $article = Http::get($a['links']['api']['news']['href'])->json();

                if (isset($article['headlines'])) {

                    $article = $article['headlines'][0];

                    $published = Carbon::parse($article['published'], 'UTC');
                    $published_date = Carbon::createFromFormat('Y-m-d H:i:s', $published);

                    $transaction = Article::updateOrCreate(
                        ['espn_id' => $article['id']],
                        [
                            'article_type' => $article['type'] ?? null,
                            'link' => $article['links']['web']['href'] ?? null,
                            'image' => $image,
                            'game_id' => $article['gameId'] ?? null,
                            'headline' => $article['headline'] ?? null,
                            'description' => $article['description'] ?? null,
                            'story' => $article['story'] ?? null,
                            'published' => $published_date
                        ]
                    );
                }
            }
            
        }

        // Iterate the Top 25 for some extra team news and previews
        $top25 = Ranking::select('team_id')
                    ->where('poll', 'ap')
                    ->latest('created_at')
                    ->limit(50)
                    ->pluck('team_id')
                    ->unique();

        foreach($top25 as $team) {

            try {

                $response = Http::get(config('espn.news') . '&team=' . $team);
                $articles = $response->json()['articles'];

                foreach ($articles as $a) {

                    if (isset($a['links']['api']['news']['href']) && in_array($a['type'], ['Preview', 'HeadlineNews', 'Story'])) {

                        if (isset($a['images'])) {
                            if ($a['type'] == 'HeadlineNews' || $a['type'] == 'Story') {
                                $image = $a['images'][0]['url'] ?? null;
                            } else {
                                if (isset($a['images'][6])) {
                                    $image = $a['images'][6]['url'] ?? null;
                                } else {
                                    $image = $a['images'][0]['url'] ?? null;
                                }
                            }
                        }

                        $article = Http::get($a['links']['api']['news']['href'])->json();

                        if (isset($article['headlines'])) {

                            $article = $article['headlines'][0];

                            $published = Carbon::parse($article['published'], 'UTC');
                            $published_date = Carbon::createFromFormat('Y-m-d H:i:s', $published);

                            $transaction = Article::updateOrCreate(
                                ['espn_id' => $article['id']],
                                [
                                    'article_type' => $article['type'] ?? null,
                                    'link' => $article['links']['web']['href'] ?? null,
                                            'image' => $image,
                                    'game_id' => $article['gameId'] ?? null,
                                    'headline' => $article['headline'] ?? null,
                                    'description' => $article['description'] ?? null,
                                    'story' => $article['story'] ?? null,
                                    'published' => $published_date
                                ]
                            );
                        }
                    }
                    
                }

            } catch (Exception $e) {
                //throw $th;
            }

        }

        FeedController::finished($this->log);

    }

}