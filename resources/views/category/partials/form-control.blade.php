<div class="form-group">
  <label for="category">Kategori</label>
  <input type="text" value="{{ old('category') ?? $category->category }}" name="category" id="category"
    class="form-control" placeholder="Surat Masuk">
  @error('category')
  <div class="text-danger mt-2 d-block">{{ $message }}</div>
  @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submit }}</button>