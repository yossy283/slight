@if (isset($Ctimelines))
    @foreach ($Ctimelines as $Ctimeline)
        <div class="card">
            <div class="card-haeder p-3 w-100 d-flex">
                <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                <div class="ml-2 d-flex flex-column flex-grow-1">
                    <p class="mb-0">{{ $Ctimeline->user->name }}</p>
                    <a href="{{ url('users/' .$Ctimeline->user->id) }}" class="text-secondary">{{ $Ctimeline->user->screen_name }}</a>
                </div>
                <div class="d-flex justify-content-end flex-grow-1">
                    <p class="mb-0 text-secondary">{{ $Ctimeline->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
            <div class="card-body">
                {{ $Ctimeline->text }}
            </div>
            <div class="card-footer py-1 d-flex justify-content-end bg-white">
                @if ($Ctimeline->user->id === Auth::user()->id)
                    <div class="dropdown mr-3 d-flex align-items-center">
                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-fw"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <form method="POST" action="{{ url('tweets/' .$Ctimeline->id) }}" class="mb-0">
                                @csrf
                                @method('DELETE')

                                <a href="{{ url('tweets/' .$Ctimeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                <button type="submit" class="dropdown-item del-btn">削除</button>
                            </form>
                        </div>
                    </div>
                @endif
                <!-- いいね機能ここから -->
                <div class="mr-3 d-flex align-items-center">
                    <a href="{{ url('tweets/' .$Ctimeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                    <p class="mb-0 text-secondary">{{ count($Ctimeline->comments) }}</p>
                </div>
                <div class="d-flex align-items-center">
                    @if (!in_array(Auth::user()->id, array_column($Ctimeline->favorites->toArray(), 'user_id'), TRUE))
                        <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                            @csrf

                            <input type="hidden" name="tweet_id" value="{{ $Ctimeline->id }}">
                            <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                        </form>
                    @else
                        <form method="POST"action="{{ url('favorites/' .array_column($Ctimeline->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                        </form>
                    @endif
                    <p class="mb-0 text-secondary">{{ count($Ctimeline->favorites) }}</p>
                </div>
                <!-- ここまで -->
            </div>
        </div>
    @endforeach
@endif
