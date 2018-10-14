<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ICommentRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Events\NewComment;

class CommentsController extends Controller
{

    private $commentRepository;

    public function __construct(ICommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'body' => 'required|string'
        ]);

        if($validator->fails())
        {
            return json()->response(['', 404]);
        }

        $comment = $this->commentRepository->create([
            'show_id' => $request['id'],
            'user_id' => Auth::user()->id,
            'body' => $request['body']
        ]);

        event(new NewComment($comment));

        return response()->json('', 200);
    }
}
