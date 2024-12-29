<div class="modal fade text-left" id="showFotoUser{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ __('Foto Pengguna') }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-md-6">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Foto Utama</label>
                    <img src="{{ asset('storage/img-produk/' . $row->foto) }}" class="foto-preview" width="100%">
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</div> 