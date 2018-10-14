<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Interfaces\IRatingRepository;
use App\Interfaces\IShowRepository;

class NewRatingListener
{

    private $ratingRepository;
    private $showRepository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(IRatingRepository $ratingRepository, IShowRepository $showRepository)
    {
        $this->ratingRepository = $ratingRepository;
        $this->showRepository = $showRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $rating = $event->rating;
        $showId = $event->showId;


        $totalRatings = $this->ratingRepository->getAll(null, null, ['show_id' => $showId]);
        $count = count($totalRatings);
        $average = 0;
        foreach($totalRatings as $rating)
        {
            $average += $rating->rating;
        }
        $average = $average / $count;

        $show = $this->showRepository->get($showId);
        $popularity = $average * $count;
        $this->showRepository->edit($showId, [
            'rating' => $average, 
            'number_ratings' => $count,
            'popularity' => $popularity
        ]);
        
    }
}
