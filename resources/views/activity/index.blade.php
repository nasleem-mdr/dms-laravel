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
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="archiveTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th data-field="nip">NIP/User</th>
            <th data-field="waktu">Waktu</th>
            <th data-field="aktivitas">Aktivitas</th>
            @if ($user->hasRole('super admin'))
            <th data-field="instansi">Instansi</th>
            @endif
            <th data-sortable="falase">Aksi</th>
          </tr>
        </thead>
        <tbody>


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
        </tbody>
      </table>

  </div>
</div>
@endsection