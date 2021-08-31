<div class="form-group">
  <label for="agency_id">Instansi</label>
  <select name="agency_id" id="agency_id" class="form-control" onchange="getPositions()">
    <option selected disabled>Pilih instansi</option>
    @if ($user->hasRole('admin'))
    <option selected value="{{ old('agency_id') ?? $user->employee->agency->id  }}">
      {{ $user->employee->agency->name }}</option>
    @endif

    @if ($user->hasRole('super admin'))
    @foreach ($agencies as $item)
    <option {{ isset($agency) ? ($item->id == $agency->id) ? 'selected' : '' : ''}} value="{{ $item->id }}">
      {{ $item->name }}</option>
    @endforeach
    @endif
  </select>
  @error('agency_id')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="position_id">Pilih Jabatan</label>
  <select name="position_id" id="position_id" class="form-control">
    <option selected disabled>Pilih satu jabatan</option>
    @if($user->hasRole('admin'))
    @foreach ($user->employee->agency->positions as $position)
    <option value="{{ old('position_id') ?? $position->id }}">{{ $position->position }}</option>
    @endforeach
    @endif
  </select>
  @error('position_id')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>


<div class="form-group">
  <label for="nip">NIP</label>
  <input type="text" name="nip" id="nip" class="form-control" value="{{ old('nip') ?? $employee->nip }}"
    placeholder="1800018411">
  @error('nip')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="name">Nama Lengkap</label>
  <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $employee->name }}"
    placeholder="Refinaldy ">
  @error('name')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="email">Email</label>
  <input type="text" name="email" id="email" class="form-control" value="{{ old('email') ?? '' }}"
    placeholder="refinaldy@test.test">
  @error('email')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>


<div class="form-group">
  <label for="address">Alamat</label>
  <input type="text" name="address" id="address" class="form-control" value="{{ old('address') ?? $employee->address }}"
    placeholder="Yogyakarta">
  @error('address')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="phone_number">No Telepon</label>
  <input type="text" name="phone_number" id="phone_number" class="form-control"
    value="{{ old('phone_number') ?? $employee->phone_number }}" placeholder="081xxxxxx">
  @error('phone_number')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="roles">Pilih role</label>
  <select name="roles[]" id="roles" class="form-control select2" multiple>



    @foreach ($roles as $role)
    <option
      {{ $user->hasRole('admin') ? (($role->name === 'super admin') ?  'disabled hidden' : '' ) : '' }}value="{{ $role->id }}">
      {{ $user->hasRole('admin') ? (($role->name === 'super admin') ?  '' : $role->name ) : $role->name  }}
    </option>
    @endforeach

    @error('role')
    <div class="text-danger mt-2 d-block">{{ $message }}</div>
    @enderror
  </select>
</div>


<button type="submit" class="btn btn-info">{{ $submit }}</button>