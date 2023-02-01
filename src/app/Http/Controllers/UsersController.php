<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Follower;
use App\Models\Favorite;
use App\Models\Comment;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users' => $all_users

        ]);
    }

    //add 2022/06/20
    public function index_follows(User $user)
    {
        $all_users = $user->getAllFollows();

        return view('users.follows', [
            'all_users' => $all_users

        ]);
    }

    public function index_followers(User $user)
    {
        $all_users = $user->getAllFollowers();

        return view('users.followers', [
            'all_users' => $all_users

        ]);
    }
    ///add end

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

         public function edit(User $user)
     {
         return view('users.edit', ['user' => $user]);
     }

     public function update(Request $request, User $user)
     {
         $data = $request->all();
         $validator = Validator::make($data, [
             'screen_name'   => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
             'name'          => ['required', 'string', 'max:255'],
             'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
             'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
         ]);
         $validator->validate();
         $user->updateProfile($data);

         return redirect('users/'.$user->id);
     }
    public function destroy($id)
    {
        //
    }

    //フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
       // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
           // フォローしていなければフォローする
           $follower->follow($user->id);
           return back();
        }

    }

    //フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();

        $is_following = $follower->isFollowing($user->id);

        if ($is_following) {
            $follower->unfollow($user->id);
            return back();
        }

    }

    public function show(Request $request, User $user, Tweet $tweet, Follower $follower,Favorite $favorite,Comment $comment)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $tweet->getUserTimeLine($user->id);
        $tweet_count = $tweet->getTweetCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        //add 2022/06/23
        $favorite_ids = $favorite->favoriteTweetIds($user->id);
        $favorite_ids = $favorite_ids->pluck('tweet_id')->toArray();
        $Ftimelines = $tweet->getUserFavoritesTimeLine($favorite_ids);

        $comment_ids = $comment->commentsTweetIds($user->id);
        $comment_ids = $comment_ids->pluck('tweet_id')->toArray();
        $Ctimelines = $tweet->getUserCommentsTimeLine($comment_ids);

        //無限スクロール用 ajaxからrequestがきたら
        if ($request->ajax()) {
            //viewでtweets/data.blade.phpと[]の中身を送る
            $data = $request->all();
            $message = $data['activated_tab'];

            switch($message) {
                case 1 :
                    $viewstring = 'users.tweets';
                    break;
                case 2 :
                    $viewstring = 'users.comments';
                    break;
                case 3 :
                    $viewstring = 'users.experiences';
                    break;
                case 4 :
                    $viewstring = 'users.questions';
                    break;
                case 5 :
                    $viewstring = 'users.favorites';
                    break;
                default :
                    Log::debug($message);
            }
            $view = view($viewstring ,[
                'user'           => $user,
                'is_following'   => $is_following,
                'is_followed'    => $is_followed,
                'timelines'      => $timelines,
                'Ftimelines'     => $Ftimelines,
                'Ctimelines'     => $Ctimelines,
                'tweet_count'    => $tweet_count,
                'follow_count'   => $follow_count,
                'follower_count' => $follower_count
            ])->render();

            return response()->json(['html'=>$view]);
        }
        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'Ftimelines'     => $Ftimelines,
            'Ctimelines'     => $Ctimelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }
}
