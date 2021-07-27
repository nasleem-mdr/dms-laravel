@extends('layouts.back')

@push('scripts')
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
  <div class="card-header">Edit Data {{ $employee->name }}</div>
  <div class="card-body">
    <form action="{{ route('employee.edit', $employee) }}" method="POST">
      @csrf
      @method('PUT')
      @include('employee.partials.form-control')
    </form>
  </div>
</div>
@endsection