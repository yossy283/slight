@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-auto bg-light sticky-top">
            <!-- side var -->
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

        <div class="col-sm-6 p-3 min-vh-100" id="post-data">
            <!--無限スクロールで表示したい部分はincludeして別のbladeファイルに書き込む
            これを行う理由は、tweet.php ajaxからリクエストがあったとき、view(tweet.data...)という風に記載するため
            tweets.dataとは.tweets/data.blade.php のこと
            id="post-data"を忘れないこと-->
            @include('tweets.data')

        </div>
    </div>
</div>


@endsection
