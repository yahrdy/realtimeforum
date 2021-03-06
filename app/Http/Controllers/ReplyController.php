<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    public function index(Question $question)
    {
        return $question->replies()->latest()->get();
    }

    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());
        return response(['reply'=>new ReplyResource($reply)],Response::HTTP_CREATED);
    }

    public function show(Question $question, Reply $reply)
    {
        return $reply;
    }

    public function update(Request $request, Reply $reply)
    {
        //
    }

    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
