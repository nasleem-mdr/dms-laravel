<div class="form-group">
  <label for="no">Nomor Arsip</label>
  <input type="text" name="no" id="no" class="form-control" value="{{ old('no') ?? $archive->no }}">
  @error('no')
  <div class=" text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="desc">Deskripsi</label>
  <input type="text" name="desc" id="desc" class="form-control" value="{{ old('desc') ?? $archive->desc }}"
    placeholder="">
  @error('desc')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="year_id">Tahun</label>
  <select name="year_id" id="year_id" class="form-control">
    <option disabled selected>Pilih tahun</option>
    @foreach ($years as $item)
    <option {{ ($archive->year_id === $item->id) ? 'selected' : ''}} value="{{  $item->id }}">{{ $item->year }}
    </option>
    @endforeach
  </select>
  @error('position_id')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<button type="submit" class="btn btn-info">{{ $submit }}</button>