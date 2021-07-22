<div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $agency->name }}"
    placeholder="Unit 1 Kabupaten Tanah Tidung">
  @error('name')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="address">Address</label>
  <input type="text" name="address" id="address" class="form-control" value="{{ old('address') ?? $agency->address }}"
    placeholder="Jalan. Nama Jalan, Kelurahan, Kecamatan, ...">
  @error('address')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="contact">Contact</label>
  <input type="text" name="contact" id="contact" class="form-control" value="{{ old('contact') ?? $agency->contact }}"
    placeholder="0812XXXXX">
  @error('contact')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<button type="submit" class="btn btn-info">{{ $submit }}</button>