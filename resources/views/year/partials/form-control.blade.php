<div class="form-group">
  <label for="year">Year</label>
  <input type="text" value="{{ old('year') ?? $year->year }}" name="year" id="year" class="form-control"
    placeholder="2030">
  @error('year')
  <div class="text-danger mt-2 d-block">{{ $message }}</div>
  @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submit }}</button>