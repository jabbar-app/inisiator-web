@extends('layouts.dashboard')

@section('content')
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <!-- Update Profile Information -->
      <div class="card mb-4">
        <div class="card-body">
          @include('profile.partials.update-profile-information-form')
        </div>
      </div>

      <!-- Update Password -->
      <div class="card mb-4">
        <div class="card-body">
          @include('profile.partials.update-password-form')
        </div>
      </div>

      <!-- Delete User -->
      <div class="card mb-4">
        <div class="card-body">
          @include('profile.partials.delete-user-form')
        </div>
      </div>
    </div>
  </div>
@endsection
