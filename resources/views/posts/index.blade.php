@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row  d-flex justify-content-center">
      <a href="/profile/{{ $current_user_id }}">
        <p>My Profile</p>
      </a>
    </div>
    @foreach ($posts as $post)
    <div class="row pt-2 pb-4">
        <div class="col-4 offset-2">
            <div class="d-flex align-items-center">
              <div class="pr-3">
                  <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width:50px;">
              </div>
              <div>
                  <div class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id }}">
                        <span class="text-dark">
                          {{ $post->user->username }}
                        </span>
                      </a>

                  </div>
              </div>
            </div>

            <hr>

            <p>
              <span class="font-weight-bold">
                <a href="/profile/{{ $post->user->id }}">
                  <span class="text-dark">
                    {{ $post->user->username }}
                  </span>
                </a>
            </span>
            {{ $post->caption }}
          </p>
        </div>
    </div>
    <div class="row">
        <div class="col-8 offset-2">
          <a href="/profile/{{ $post->user->id}}">
            <img src="/storage/{{ $post->image }}" class="w-100">
          </a>
        </div>
    </div>
    @endforeach
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        {{ $posts->links() }}
      </div>
    </div>
</div>
@endsection
