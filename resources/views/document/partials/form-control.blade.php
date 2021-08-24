@if ($user->hasRole('super admin'))
<div class="form-group">
  <label for="agency_id">Agency</label>
  <select name="agency_id" id="agency_id" class="form-control" onchange="getPositions()">
    <option selected disabled>Choose a Agency</option>

    @foreach ($agencies as $agency)
    <option {{ ( isset($document->agency->id) ? $agency->id === $document->agency->id : '') ? 'selected' : '' }}
      value="{{ $agency->id }}">
      {{ $agency->name }}</option>
    @endforeach

  </select>
  @error('agency_id')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>
@endif

<div class="form-group">
  <label for="no">Nomor Dokumen</label>
  <input type="text" name="no" id="no" class="form-control" value="{{ old('no') ?? $document->no }}">
  @error('no')
  <div class=" text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="desc">Deskripsi</label>
  <input type="text" name="desc" id="desc" class="form-control" value="{{ old('desc') ?? $document->desc }}"
    placeholder="">
  @error('desc')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="year_id">Tahun</label>
  <select name="year_id" id="year_id" class="form-control">
    <option disabled selected>Pilih Tahun</option>
    @foreach ($years as $item)
    <option {{ ($document->year_id === $item->id) ? 'selected' : ''}} value="{{  $item->id }}">{{ $item->year }}
    </option>
    @endforeach
  </select>
  @error('position_id')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="category_id">Kategori</label>
  <select name="category_id" id="category_id" class="form-control">
    <option disabled selected>Pilih Kategori</option>
    @foreach ($categories as $item)
    <option {{ ($document->document_category_id === $item->id) ? 'selected' : ''}}
      value="{{ old('category_id') ??  $item->id }}">
      {{ $item->category }}
    </option>
    @endforeach
  </select>
  @error('position_id')
  <div class="text-danger mt-1 d-block">{{ $message }}</div>
  @enderror
</div>

<div class="form-group">
  <label for="file">Unggah Dokumen</label>
  <input type="file" class="form-control-file" id="file" name="file" placeholder="input">
  <small>maksimal 5 MB</small>
</div>

<button type=" submit" class="btn btn-info">{{ $submit }}</button>