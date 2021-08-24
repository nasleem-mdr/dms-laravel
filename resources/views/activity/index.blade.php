@extends('layouts.back')

@push('scripts')
<script>
  let buttonCollapse = document.getElementById('btnCollapse')

</script>
@endpush

@section('content')
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

    @foreach ($item as $date => $activities)

    <h5>{{ $date }}</h5>

    @foreach ($activities as $activity)
    <li class=" ml-5">
      @if ($user->hasRole('super admin') || $user->hasRole('pegawai') && !$user->hasRole('admin'))
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




    </ul>

  </div>
</div>
@endsection