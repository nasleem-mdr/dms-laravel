<div class="form-group">
  <label for="name">Nama Unit</label>
  <input type="text" name="name" id="name" class="form-control" value="{{ old('agency_name') ?? $agency->name}}"
    placeholder="Unit 1 Kabupaten Tanah Tidung" readonly>
  <input type="text" name="agency_id" id="id" class="form-control" value="{{ old('agency_id') ?? $agency->id }}" hidden>
  @error('name')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="position">Jabatan</label>
  <input type="text" name="position" id="position" class="form-control"
    value="{{ old('position') ?? $position->position }}" placeholder="Sekretaris">
  @error('position')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<button type="submit" class="btn btn-info">{{ $submit }}</button>