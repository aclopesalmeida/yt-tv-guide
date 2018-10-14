<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\IRatingRepository;
use App\Interfaces\IShowRepository;
use App\Events\NewRating;

class RatingsController extends Controller
{

    private $ratingRepository;
    private $showRepository;
     
    public function __construct(IRatingRepository $ratingRepository, IShowRepository $showRepository)
    {
        $this->ratingRepository = $ratingRepository;
        $this->showRepository = $showRepository;
    }
    
   
    public function store(Request $request)
    {
        $showId =  $request['show_id'];
        $rating = $request['number'];

        $data = [
            'user_id' => Auth::user()->id,
            'show_id' => $showId,
            'rating' => $rating
        ];

        // check if the user has already rated this show before:
        $userRating = Auth::user()->ratings->where('show_id', $showId)->first();
        if(!is_null($userRating))
        {
            $this->ratingRepository->delete($userRating->id);
        }
        $this->ratingRepository->create($data);


        event(new NewRating($rating, $showId));
        

        return redirect()->route('shows.index', ['id' => $showId]);
    }
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
