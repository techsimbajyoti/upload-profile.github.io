@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
               
                <div>
                    <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                            @csrf
                    <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Upload Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <input type="submit" value="Upload" class="btn btn-primary">
                    </form>
                </div>

               
                <div class="card">
                <div class="card-header">{{ __('User Profile Image') }}</div>
                <div class="card-body">
                  @foreach($user as $users)
                      <img src="{{ asset('uploads/'.$users->image) }}" alt="image" style="height:100px;width:100px">
                      <br><br>
                    <form action="{{ route('delete') }}" method>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want delete himself.')">Delete User</button>
                    </form>
                </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
