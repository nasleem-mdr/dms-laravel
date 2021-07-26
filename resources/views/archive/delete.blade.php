<!-- Button trigger modal -->
<a href="#" class="text-danger" data-toggle="modal" data-target="#archive-{{ $archive->id }}">
  Delete
</a>

<!-- Modal -->
<div class="modal fade" id="archive-{{ $archive->id }}" tabindex="-1" aria-labelledby="archive-{{ $archive->id }}Label"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="archive-{{ $archive->id }}Label"> Anda yakin ingin menghapus arsip
          {{ $archive->no  }}? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="d-flex justify-content-arround">
          <div class="w-100">
            <form action="{{ route('archive.delete', $archive) }}" method="post">
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