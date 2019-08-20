@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Teacher Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

      <form action="{{ route('admin.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $teacher->user_id }}">
               <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name"  value="{{ $teacher->name}}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
             <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus value="{{ $teacher->email}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
                <div class="form-group row">
                <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>
                <div class="col-md-6">
                    <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" required autocomplete="department" autofocus value="{{ $teacher->department}}">
                    @error('department')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
              <div style="text-align: right;">
                <button type="button" class="btn btn-default addTeach" onclick="history.back();">Cancel</button>
                <button type="submit" class="btn btn-default addTeach">Save</button>
              </div>  
        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
