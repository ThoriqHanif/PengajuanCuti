<div class="modal fade" tabindex="-1" role="dialog" id="modalEditTypes">
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

                        <input type="hidden" class="form-control" id="type_id" name="id">

                        
                    <div class="form-group">
                        <label>Nama Tipe</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="eg. Marketing" name="name"
                                id="name_edit" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="duration">Jumlah Cuti</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="eg. 12" name="duration"
                                    id="duration_edit" >
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="time">Skala dalam 1 Tahun</label>
                            <div class="form-group">
                                <select class="form-control selectric" name="time" id="time_edit">
                                    <option value="" selected @readonly(true)>Pilih Skala</option>
                                    <option value="hari">Hari</option>
                                    <option value="minggu">Minggu</option>
                                    <option value="bulan">Bulan</option>
                                </select>
                            </div>
                        </div>
                        {{-- <input type="number" id="duration_in_days_edit" name="duration_in_days"> --}}

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