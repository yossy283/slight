@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="100" height="100">
                        <div class="mt-3 d-flex flex-column">
                            <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                            <span class="text-secondary">{{ $user->screen_name }}</span>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if ($user->id === Auth::user()->id)
                                    <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if ($is_following)
                                        <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" class="btn btn-primary">フォローする</button>
                                        </form>
                                    @endif

                                    @if ($is_followed)
                                        <span class="mt-2 px-1 bg-secondary text-light">フォローされています</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">
                                <url1><a href="{{ url('users/' .$user->id .'/follows') }}" class="font-weight-bold"> フォロー数 <span class="fw-bold">{{ $follow_count }} </span></a></url1>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <url1><a href="{{ url('users/' .$user->id .'/followers') }}" class="font-weight-bold"> フォロワー数 <span class="fw-bold">{{ $follower_count }} </span></a></url1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link active"
                        id="tweets-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#tweets"
                        type="button"
                        role="tab"
                        aria-controls="tweets"
                        aria-selected="true"
                        >
                        ツイート
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="comments-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#comments"
                        type="button"
                        role="tab"
                        aria-controls="comments"
                        aria-selected="false"
                        >
                        コメント
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="experiences-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#experiences"
                        type="button"
                        role="tab"
                        aria-controls="experiences"
                        aria-selected="false"
                        >
                        体験談
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="questions-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#questions"
                        type="button"
                        role="tab"
                        aria-controls="questions"
                        aria-selected="false"
                        >
                        相談板
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="favorites-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#favorites"
                        type="button"
                        role="tab"
                        aria-controls="favorites"
                        aria-selected="false"
                        >
                        いいね
                    </button>
                </li>
            </ul>
            <div class="tab-content justify-content-center">
                <div  class="tab-pane active" id="tweets" role="tabpanel" aria-labelledby="tweets-tab">
                    @if (isset($timelines))
                        @foreach ($timelines as $timeline)
                            <div class="card">
                                <div class="card-haeder p-3 w-100 d-flex">
                                    <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                                    <div class="ml-2 d-flex flex-column flex-grow-1">
                                        <p class="mb-0">{{ $timeline->user->name }}</p>
                                        <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->screen_name }}</a>
                                    </div>
                                    <div class="d-flex justify-content-end flex-grow-1">
                                        <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $timeline->text }}
                                </div>
                                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                                    @if ($timeline->user->id === Auth::user()->id)
                                        <div class="dropdown mr-3 d-flex align-items-center">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-fw"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <form method="POST" action="{{ url('tweets/' .$timeline->id) }}" class="mb-0">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ url('tweets/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                                    <button type="submit" class="dropdown-item del-btn">削除</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- いいね機能ここから -->
                                    <div class="mr-3 d-flex align-items-center">
                                        <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                        <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if (!in_array(Auth::user()->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                            <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                                @csrf

                                                <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
                                                <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                            </form>
                                        @else
                                            <form method="POST"action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                            </form>
                                        @endif
                                        <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
                                    </div>
                                    <!-- ここまで -->
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="tab-pane" id="comments" role="tabpanel" aria-labelledby="comments-tab" >
                </div>
                <div class="tab-pane" id="experiences" role="tabpanel" aria-labelledby="experiences-tab" >
                </div>
                <div class="tab-pane" id="questions" role="tabpanel" aria-labelledby="questions-tab" >
                </div>
                <div class="tab-pane" id="favorites" role="tabpanel" aria-labelledby="favorites-tab" >
                </div>
            </div>
        </div>
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $timelines->links() }}
    </div>
</div>
@endsection
