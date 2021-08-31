@extends('layouts.back')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
@endsection


@push('script_select2')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
  $('.select2').select2(
    {
      placeholder: "  Pilih Roles"
    }
  );
  });
</script>

<script>
  function destroyElement(el){
    el.innerHTML = '';
  }

  function getPositions(){
    
    const el = document.getElementById('agency_id')
    let agencyID = el.value;

    const selectEl = document.getElementById('position_id');
          destroyElement(selectEl);
          var defaultOptionEl = document.createElement('option');
              defaultOptionEl.setAttribute('selected','selected');
              defaultOptionEl.setAttribute('disabled','disabled');
              defaultOptionEl.innerHTML = 'Choose a position';
              selectEl.appendChild(defaultOptionEl);

    fetch('/agency/' + agencyID + '/positions')
        .then(response => response.json())
        .then(data => {
          console.log(data);
          if(data.length === 0 ){
            var defaultOptionEl = document.createElement('option');
              defaultOptionEl.setAttribute('disabled','disabled');
              defaultOptionEl.innerHTML = 'Nothing position at this agency';
              selectEl.appendChild(defaultOptionEl);
          }

            data.forEach(position => {
              var optionEl = document.createElement('option');
              optionEl.setAttribute('value', position['id']);
              optionEl.innerHTML = position['position'];
              selectEl.appendChild(optionEl);
            });
            
        });
  }
</script>
@endpush


@section('content')

@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@section('content')
<div class="card">
  <div class="card-header">Tambah Pegawai Baru</div>
  <div class="card-body">
    <form action="{{ route('employee.create') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @include('employee.partials.form-control')
    </form>
  </div>
</div>
@endsection