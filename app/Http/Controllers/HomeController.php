<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Show;
use App\Interfaces\IRatingRepository;
use App\Interfaces\IShowRepository;


class HomeController extends Controller
{
    private $showRepository;
    private $ratingRepository;
    
    public function __construct(IShowRepository $showRepository, IRatingRepository $ratingRepository)
    {
         $this->showRepository = $showRepository;
         $this->ratingRepository = $ratingRepository;
    }
 


    public function index()
    {
        $latestShows = $this->showRepository->getAll(
            ['created_at', 'DESC'], 
            6, 
            null,
            ['seasons' => function($q) {
                $q->orderBy('number', 'desc');
            }]
        );
    
         $popularShows = $this->showRepository->getAll(['popularity', 'desc'], 6);
         {

         }

        return view('home')->with([
            'latestShows' => $latestShows,
            'popularShows' => $popularShows
            ]);
    }

 
}
