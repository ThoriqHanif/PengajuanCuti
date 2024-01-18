<div class="modal fade" tabindex="-1" role="dialog" id="modalEditDivisi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Divisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form action="{{ isset($divisions) ? route('divisions.update', $divisions->id) : route('divisions.store') }}" method="post" id="formEditDivisions">
                    @csrf
                    @method('put') --}}

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="division_id" name="id">

                        <label>Nama Divisi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="eg. Marketing" name="name"
                                id="name_edit">
                        </div>
                    </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary btn-update">Update</button>
            </div>
            {{-- </form> --}}
        </div>
    </div>
</div>