<!-- Button trigger modal -->
<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#agency-{{ $agency->id }}">
  Delete
</button>

<!-- Modal -->
<div class="modal fade" id="agency-{{ $agency->id }}" tabindex="-1" aria-labelledby="agency-{{ $agency->id }}Label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agency-{{ $agency->id }}Label"> Anda yakin ingin menghapus instansi
          {{ $agency->name  }}? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="d-flex justify-content-arround">
          <div class="w-100">
            <form action="{{ route('agency.delete', $agency) }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-block">Delete</button>
            </form>
          </div>
          <div class="mx-1"></div>
          <div class="w-100">
            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>