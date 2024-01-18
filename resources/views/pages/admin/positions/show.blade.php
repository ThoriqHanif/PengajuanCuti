<div class="modal fade" tabindex="-1" role="dialog" id="modalDetailPosisi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Posisi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="eg. Staff" name="name"
                                id="name_detail" readonly>
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> --}}
                <button type="submit" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
            {{-- </form> --}}
        </div>
    </div>
</div>