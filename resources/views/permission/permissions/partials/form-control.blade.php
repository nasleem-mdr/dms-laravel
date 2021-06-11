<div class="form-group">
  <label for="name">Name</label>
  <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $permission->name }}">
</div>
<div class="form-group">
  <label for="guard_name">Guard Name</label>
  <input type="text" class="form-control" name="guard_name" id="guard_name" placeholder='default to "web"'
    value="{{  old('guard_name') ?? $permission->guard_name }}">
</div>
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submit }}</button>
</div>