<div class="form-group">
  <label for="nip">NIP</label>
  <input type="text" name="nip" id="nip" class="form-control" value="{{ $employee->nip }}" readonly>
  @error('nip')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="name">Nama</label>
  <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $employee->name }}">
  @error('name')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="email">Email</label>
  <input type="text" name="email" id="email" class="form-control" value="{{ old('email') ?? $user->email }}">
  @error('email')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="address">Alamat</label>
  <input type="text" name="address" id="address" class="form-control" value="{{ old('address') ?? $employee->address }}"
    placeholder="Jalan. Kel. Kec.">
  @error('address')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="phone_number">Nomor Telpon</label>
  <input type="text" name="phone_number" id="phone_number" class="form-control"
    value="{{ old('phone_number') ?? $employee->phone_number }}" placeholder="081xxxxxx">
  @error('phone_number')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>


<button type="submit" class="btn btn-info">{{ $submit }}</button>