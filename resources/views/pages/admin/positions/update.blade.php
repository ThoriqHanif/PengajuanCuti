<div class="modal fade" tabindex="-1" role="dialog" id="modalEditPosisi">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Posisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <form action="{{ isset($divisions) ? route('divisions.update', $divisions->id) : route('divisions.store') }}" method="post" id="formEditDivisions">
                    @csrf
                    @method('put') --}}
                <div class="row">

                    <div class="col-lg-8">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="position_id" name="id">

                            <label>Nama Posisi</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="eg. Staff" name="name"
                                    id="name_edit">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Level Posisi</label>
                            <div class="input-group">
                                <select name="level" id="level_edit" class="form-control selectric">
                                    {{-- <option>Pilih Level</option> --}}
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>

                                </select>
                            </div>
                        </div>
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
