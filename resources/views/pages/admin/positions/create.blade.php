<div class="modal fade" tabindex="-1" role="dialog" id="modalCreatePosisi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('positions.store') }}" method="post" id="formPositions">
                    @csrf
                    <div class="form-group">
                        <label>Nama Posisi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="eg. Direktur" name="name"
                                id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>LevelPosisi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="eg. 1" name="level"
                                id="level">
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-simpan">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>