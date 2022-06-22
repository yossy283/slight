@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-auto bg-light sticky-top">
            <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                <!--
                <a href="/" class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                    <i class="bi-bootstrap fs-1"></i>
                </a>
                -->
                <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link py-3 px-2" title="Home" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                            <i class="bi-house fs-1"></i> <!--<span class="ms-1 d-none d-sm-inline">Home</span>-->
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                            <i class="bi bi-chat-text fs-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
                            <i class="bi bi-chat-text-fill fs-1"></i>

                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
                            <i class="bi bi-door-open fs-1"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Customers">
                            <i class="bi bi-file-earmark-person fs-1"></i>
                        </a>
                    </li>


                </ul>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center justify-content-center p-4 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                        <!--<i class="bi-person-circle h2"></i> -->
                        <img src="{{ asset('storage/profile_image/' .auth()->user()->profile_image) }}" class="rounded-circle" width="30" height="30">
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                        <li><a class="dropdown-item" href="{{ url('users/' .auth()->user()->id) }}">プロフィール</a></li>
                        <li><a class="dropdown-item" href="#">設定</a></li>
                        <a class="dropdown-item"　href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('ログアウト') }}
                        </a>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6 p-3 min-vh-100">
            @if (isset($timelines))
                @foreach ($timelines as $timeline)
                <div class="col-ms-8  mb-2 text-right">
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image) }}" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0">{{ $timeline->user->name }}</p>
                                <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->screen_name }}</a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($timeline->text)) !!}
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
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                            </div>
                            <!-- いいね機能ここから -->
                            <div class="d-flex align-items-center">
                                @if (!in_array($user->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                        @csrf

                                        <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[$user->id]) }}" class="mb-0">
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
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="my-4 d-flex justify-content-center">
        {{ $timelines->links() }}
    </div>
</div>
@endsection
