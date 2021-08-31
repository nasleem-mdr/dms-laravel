@extends('layouts.back')

@section('content')

<div class="card mb-lg-5">

  <div class="card">
    <div class="card-header text-white" style="background-color: #005ea3;">
      Aktivitas
      @if (!$user->hasRole(["super admin", 'admin']))
      Anda Pada
      @endif
      Sistem
      @if ($user->hasRole('admin'))
      {{ $user->employee->agency->name }}
      @endif
    </div>
    <div class="card-body">

      {{-- super admin --}}
      @if ($user->hasRole('super admin'))
      <!-- Button trigger modal -->
      @foreach ($agencies as $agency)
      <button onclick="loadActivity({{ $agency->id }})" type="button" class="btn btn-primary" data-toggle="modal"
        data-target="#staticBackdrop">
        {{ $agency->name }}
      </button>
      @endforeach
      <!-- Modal -->
      <div class="modal fade modal-dialog-scrollable" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="agencyName">Aktivitas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="logActivity" class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      {{--batas super admin  --}}
      @else


      @foreach ($items as $date => $activities)

      <h5>{{ $date }}</h5>

      @foreach ($activities as $activity)
      <li class=" ml-5">
        @if ($user->hasRole('pegawai') && !$user->hasRole('admin'))
        {{ $activity->user->username == $user->username ? 'Anda' : $activity->user->username }}
        @else
        {{ $activity->username == $user->username ? 'Anda' : $activity->username }}
        @endif

        {{ $activity->activity }}
        pada pukul {{ $activity->created_at->format('G:i:s') }}
        @if ($user->hasRole('super admin'))
        di
        {{ $activity->user->employee->agency->name }}
        @else

        @endif

      </li>
      @endforeach

      @endforeach
      @endif
    </div>
  </div>
  @endsection


  @push('scripts')
  <script src="{{ asset('js/log_activity.js') }}"></script>
  @endpush