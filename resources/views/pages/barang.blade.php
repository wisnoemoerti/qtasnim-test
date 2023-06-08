@extends('layouts.template')
@section('contents')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Projects</h6>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col d-flex align-items-center">
                    <div class="m-0 font-weight-bold text-primary">Filter</div>
                </div>
                <div class="col">
                    <label class="m-0 font-weight-bold text-primary">Nama Barang</label>
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for Nama Barang"
                            aria-label="Search" aria-describedby="basic-addon2" name="nama_barang" id="nama_barang">
                </div>
                <div class="col">
                    <label class="m-0 font-weight-bold text-primary">Start Date</label>
                    <input type="date" class="form-control bg-light border-0 small" placeholder="Search for Nama Barang"
                        aria-label="Search" aria-describedby="basic-addon2" name="start_date" id="start_date">
                </div>
                <div class="col">
                    <label class="m-0 font-weight-bold text-primary">End Date</label>
                    <input type="date" class="form-control bg-light border-0 small" placeholder="Search for Nama Barang"
                    aria-label="Search" aria-describedby="basic-addon2" name="end_date" id="end_date">
                </div>
                <div class="col d-flex align-items-end ">
                    <button class="btn btn-info btn-icon-split mr-2" id="search"> 
                        <span class="icon text-white-50">
                            <i class="fas fa-search fa-sm"></i>
                        </span>
                        <span class="text">Search</span>
                    </button>
                    <button class="btn btn-secondary btn-icon-split" id="clear_search">
                        <span class="icon text-white-50">
                            <i class="fas fa-align-justify fa-sm"></i>
                        </span>
                        <span class="text">Clear</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex align-items-end mb-4">
                    <button class="btn btn-primary btn-icon-split mr-2" id='create'>
                        <span class="icon text-white-50">
                            <i class="fas fa-plus fa-sm"></i>
                        </span>
                        <span class="text">New</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Action</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Jumlah Terjual</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jenis Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <form id="form">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLabel">Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" class="form-control">
                <div class="row">
                    <div class="col-6">
                        <label class="m-0 font-weight-bold text-primary">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control bg-light border-0 small" id="nama_input" placeholder="Nama Barang"
                        aria-label="Search" aria-describedby="basic-addon2" required>
                    </div>
                    <div class="col-6">
                        <label class="m-0 font-weight-bold text-primary">Stok</label>
                        <input type="number" name="stok" class="form-control bg-light border-0 small" placeholder="Stok"
                        aria-label="Search" aria-describedby="basic-addon2" required min="0">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <label class="m-0 font-weight-bold text-primary">Jumlah Terjual</label>
                        <input name="jumlah_terjual" type="number" class="form-control bg-light border-0 small" placeholder="Jumlah Terjual"
                        aria-label="Search" aria-describedby="basic-addon2" required>
                    </div>
                    <div class="col">
                        <label class="m-0 font-weight-bold text-primary">Tanggal Transaksi</label>
                        <input name="tanggal_transaksi" type="date" class="form-control bg-light border-0 small" placeholder="Tanggal Transaksi"
                        aria-label="Search" aria-describedby="basic-addon2" required>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <label class="m-0 font-weight-bold text-primary">Jenis Barang</label>
                        <input type="text" name="jenis_barang" class="form-control bg-light border-0 small" placeholder="Jenis Barang"
                        aria-label="Search" aria-describedby="basic-addon2" required >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submit">Save changes</button>
            </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLabel">Attention</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="delete_id" class="form-control">
                <label class="m-0 font-weight-bold">Apakah anda yakin menghapus data yang di pilih</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitdelete">Yes</button>
            </div>
            </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        var ids = [];

        const dt = $('#dataTable').DataTable({
            // ordering: false,
            responsive: true,
            processing: true,
            serverSide: true,
            saveState: true,
            searching: false,
            ajax: {
                url: '{{ route('datatables') }}',
                data: function ( d ) {
                    d.nama_barang = $('#nama_barang').val();
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false,orderable:false },
                { data: 'actions', searchable: false,orderable:false },
                { data: 'nama_barang', name: 'nama_barang' },
                { data: 'stok', name: 'stok' },
                { data: 'jumlah_terjual', name: 'jumlah_terjual' },
                { data: 'tanggal_transaksi', name: 'tanggal_transaksi' },
                { data: 'jenis_barang', name: 'jenis_barang' },
            ],
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });
        
        $('#search').click(function(){
            $('#dataTable').DataTable().ajax.reload();
        })

        $('#clear_search').click(function(){
            $('#nama_barang').val(null);
            $('#start_date').val('');
            $('#end_date').val('');
            $('#dataTable').DataTable().ajax.reload();
        })

        

        $("#chkAll").click(function () {
        //$('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
        var cols = dt.column(1).nodes(),
            state = this.checked;
        for (var i = 0; i < cols.length; i += 1) {
            cols[i].querySelector("input[type='checkbox']").checked = state;
        }
        });
        
        $('#dataTable').on('click', '#delete', function (e) {
            $('#deleteModal').modal('show');
            $("input[name='delete_id']").val($(this).data('id'));
            
        });

        $('#create').click(function(e){
            $('#myModal').modal('show');
        });

        $('#dataTable').on('click', '#update', function (e) {
            $('#myModal').modal('show');
            $("#nama_input").val($(this).data('name'));
            $("input[name='stok']").val($(this).data('stok'));
            $("input[name='jumlah_terjual']").val($(this).data('jumlah'));
            $("input[name='tanggal_transaksi']").val($(this).data('tanggal'));
            $("input[name='jenis_barang']").val($(this).data('jenis'));
            $("input[name='id']").val($(this).data('id'));
        });


        $('#myModal').on('hidden.bs.modal', function () {
            $("input[name='id']").val($(this).data('id'));
            $('#form')[0].reset();
        });

        $("#submitdelete").click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let id = $("input[name='delete_id']").val();
            
            e.preventDefault();
                $.ajax({
                type: "DELETE",
                url: '{{route("barang_crud")}}',
                data: {
                    id:id,
                },
                // processData: false,
                // contentType: false,
                success: function (data) {
                    console.log(data);
                    $('#dataTable').DataTable().ajax.reload();
                    $('#deleteModal').modal('hide');
                    $("input[name='delete_id']").val(null);
                    toastr.success(data.message, {
                        timeOut: 5000
                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        // Submit Form
        $('#form').submit(function (e) {
            // showLoading();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var formData = new FormData($("#form")[0]);
                $.ajax({
                type: "POST",
                url: '{{route("barang_crud")}}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    $('#dataTable').DataTable().ajax.reload();
                    $('#myModal').modal('hide');
                    $('#form')[0].reset();
                    toastr.success(data.message, {
                        timeOut: 5000
                    });
                },
                error: function (data) {
                    console.log(data);
                }
            });
            
            
        });

    });
</script>
@endsection