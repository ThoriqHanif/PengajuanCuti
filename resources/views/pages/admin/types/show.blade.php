<div class="modal fade" tabindex="-1" role="dialog" id="modalDetailTypes">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Tipe Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Tipe</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="eg. Marketing" name="name"
                                id="name_detail" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="duration">Jumlah Cuti</label>
                            <div class="input-group">
                                <input type="number" class="form-control" placeholder="eg. 12" name="duration"
                                    id="duration_detail" readonly>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="time">Skala dalam 1 Tahun</label>
                            <div class="input-group">
                                <select class="form-control selectric" name="time" id="time_detail" disabled>
                                    <option value="" selected @readonly(true)>Pilih Skala</option>
                                    <option value="hari">Hari</option>
                                    <option value="minggu">Minggu</option>
                                    <option value="bulan">Bulan</option>
                                </select>
                            </div>
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