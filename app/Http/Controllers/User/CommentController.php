<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        
        $comment = Comment::create($input);
        
        if($comment) {
            $data = [
                'comments' => [$comment],
                'article_id' => $comment->article_id,
            ];
            $html = view('user.comment.comment', $data)->render();

            return response()->json([
                'status' => true,
                'html' => $html,
                'message' => "You've commented successfully.",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong, please try again later.'
            ]);
        }
    }
}
