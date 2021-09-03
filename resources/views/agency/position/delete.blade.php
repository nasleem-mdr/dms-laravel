<!-- Button trigger modal -->
<button type="button" class="btn btn-danger " data-toggle="modal" data-target="#position-{{ $position->id }}">
  Delete
</button>

<!-- Modal -->
<div class="modal fade" id="position-{{ $position->id }}" tabindex="-1"
  aria-labelledby="position-{{ $position->id }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col">
          <h5 class="modal-title" id="position-{{ $position->id }}Label"> Anda yakin ingin menghapus jabatan
            {{ $position->position  }} pada {{ $agency->name }}? </h5>
          <p>
            Perhatian : Jika anda menghapus jabatan pada unit/instansi ini, maka seluruh pegawai pada unit ini yang
            memiliki jabatan {{ $position->id }} ini sementara tidak memiliki jabatan.
        </div>
        </p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="d-flex justify-content-arround">
          <div class="w-100">
            <form action="{{ route('position.delete', [$agency, $position]) }}" method="post">
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