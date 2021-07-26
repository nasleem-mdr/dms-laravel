<!-- Button trigger modal -->
<a href="#" class="text-danger" data-toggle="modal" data-target="#document-{{ $document->id }}">
  Delete
</a>

<!-- Modal -->
<div class="modal fade" id="document-{{ $document->id }}" tabindex="-1"
  aria-labelledby="document-{{ $document->id }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="document-{{ $document->id }}Label"> Anda yakin ingin menghapus dokumen
          {{ $document->file  }}? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="d-flex justify-content-arround">
          <div class="w-100">
            <form action="{{ route('document.delete', $document) }}" method="post">
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