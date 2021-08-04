@extends('layouts.back')

@push('scripts')

@endpush

@section('content')

<div class="row mt-4 justify-content-center">
  <div class="col-md-4">
    <div class="card-header text-center">
      Ganti Foto
    </div>
    <div class="card">
      <div class="card-body pb-4">
        <div class="d-flex flex-column align-items-center text-center">
          <img id="imageResult"
            src="{{ ($employee->profile_picture === 'default-profile.png') ? asset('/images/profile/default-profile.png') :  asset('/images/profile/employees/' . $employee->agency->name . '/' . $employee->profile_picture)  }}"
            alt="{{ $employee->profile_picture}}" alt="Admin" class="" width="150">
          <hr>
          <form action="{{ route('profile.profile_picture', $employee)  }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="file">Upload Foto Profil, Pastikan Ukuran foto 1:1</label>
              <input onchange="readURL(this);" type="file" class="form-control-file" id="upload" name="profile_picture">
              <small>max 5 MB</small>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-outline-info">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection