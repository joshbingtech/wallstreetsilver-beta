<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        if(Auth::check()) {
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
        } else {
            return response()->json([
                'status' => false,
                'message' => "Unauthorised user."
            ]);
        }
    }

    public function like(Request $request)
    {
        if(Auth::check()) {
            $comment_id = $request->get('comment_id');
            $user_id = Auth::user()->id;
            $reaction = Reaction::where('comment_id', $comment_id)->where('user_id', $user_id)->where('action', 1)->first();
            if($reaction) {
                $delete_like = Reaction::where('comment_id', $comment_id)->where('user_id', $user_id)->where('action', 1)->delete();
                return response()->json(['status' => true, 'action' => 'delete']);
            } else {
                $data['comment_id'] = $comment_id;
                $data['user_id'] = $user_id;
                $data['action'] = 1;
                $like = Reaction::create($data);
                return response()->json(['status' => true, 'action' => 'like']);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Unauthorised user."
            ]);
        }
    }

    public function dislike(Request $request)
    {
        if(Auth::check()) {
            $comment_id = $request->get('comment_id');
            $user_id = Auth::user()->id;
            $reaction = Reaction::where('comment_id', $comment_id)->where('user_id', $user_id)->where('action', 0)->first();
            if($reaction) {
                $delete_like = Reaction::where('comment_id', $comment_id)->where('user_id', $user_id)->where('action', 0)->delete();
                return response()->json(['status' => true, 'action' => 'delete']);
            } else {
                $data['comment_id'] = $comment_id;
                $data['user_id'] = $user_id;
                $data['action'] = 0;
                $like = Reaction::create($data);
                return response()->json(['status' => true, 'action' => 'dislike']);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => "Unauthorised user."
            ]);
        }
    }
}
