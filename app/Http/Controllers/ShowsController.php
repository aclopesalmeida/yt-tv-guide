<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Interfaces\IShowRepository;
use App\Interfaces\ICommentRepository;


class ShowsController extends Controller
{
    private $showRepository;
    
    public function __construct(IShowRepository $showRepository, ICommentRepository $commentRepository)
    {
         $this->showRepository = $showRepository;
         $this->commentRepository = $commentRepository;
    }


    public function index(Request $request)
    {

        $show = $this->showRepository->get($request['id'], ['seasons']);
        $comments = $this->commentRepository->getAll(['created_at', 'desc'], null, ['show_id' => $request['id']], ['user']);
        $user = null;
        $userRating = null;
        
        if(!is_null(Auth::user()))
        {
            $user = Auth::user();
            $userRating = Auth::user()->ratings->where('show_id', $show->id)->first()->rating ?? null;
        }

        return view('shows.show')->with(
            ['show' => $show, 
            'userRating' => $userRating, 
            'user' => $user,
            'comments' => $comments
        ]);
    }

    public function show(Request $request)
    {
        $show = $this->showRepository->get($request['show_id'], ['seasons']);
        $seasonId = $request['season_id'];
        $playlistId = $show->seasons->where('number', $seasonId)->first()->youtube_id;

        $client = new Client();
        $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=6&key=' . env('YOUTUBE_KEY') . '&playlistId=' . $playlistId;

        if(isset($request['page']) && !empty($request['page']) )
        {
            $url .= '&pageToken=' . $request['page'];
        }
        
        try {
            $call = $client->request('GET', $url);
        }
        catch(\GuzzleHttp\Exception\ClientException $e) 
        {
            return response()->view('errors.api_call', [], 500);
        }
        $response = $call->getBody();
        $response = json_decode($response, true);
        $totalResults = $response['pageInfo']['totalResults'];
        $nextPage = $response['nextPageToken'] ?? '';
        $videos = $response['items'];
        // getting the 'position' property of the last element of the response and adding 1 because it's an associative array
        $endLoop = (end($response['items'])['snippet']['position'] + 1) >= $totalResults ? true : false;
     
        // if it's an ajax call, load partial view:
        $view = isset($request['page']) ? 'inc.videos' : 'shows.season'; 
        return view($view)->with([
            'videos' => $videos, 
            'show' => $show,
            'currentSeason' => $seasonId,
            'totalResults' => $totalResults,
            'nextPage' => $nextPage,
            'endLoop' => $endLoop
        ]);
    }


}
