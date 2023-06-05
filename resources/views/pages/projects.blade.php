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
                    <label class="m-0 font-weight-bold text-primary">Project</label>
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for Project"
                            aria-label="Search" aria-describedby="basic-addon2" name="project_filter" id="project_filter">
                </div>
                <div class="col">
                    <label class="m-0 font-weight-bold text-primary">Client</label>
                    <select class="form-control bg-light border-0 small" name="client_filter" id="client_filter">
                        <option value="">All Client</option>
                        @foreach ($client as $item => $value)
                        <option value="{{$value->client_id}}">{{$value->client_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label class="m-0 font-weight-bold text-primary">Status</label>
                    <select class="form-control bg-light border-0 small" name="project_status_filter" id="project_status_filter">
                        <option value="">All Status</option>
                        <option value="OPEN">OPEN</option>
                        <option value="DOING">DOING</option>
                        <option value="DONE">DONE</option>
                    </select>
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
                    <button class="btn btn-danger btn-icon-split" id="delete">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash fa-sm"></i>
                        </span>
                        <span class="text">Delete</span>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th><input class="form-control" type="checkbox" id="chkAll" /></th>
                            <th>Action</th>
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Project Start</th>
                            <th>Project End</th>
                            <th>Status</th>
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
                <h5 class="modal-title m-0 font-weight-bold text-primary" id="exampleModalLabel">Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="project_id" class="form-control">
                <div class="row">
                    <div class="col-6">
                        <label class="m-0 font-weight-bold text-primary">Project</label>
                        <input type="text" name="project_name" class="form-control bg-light border-0 small" placeholder="Name off Project"
                        aria-label="Search" aria-describedby="basic-addon2" required>
                    </div>
                    <div class="col-6">
                        <label class="m-0 font-weight-bold text-primary">Client</label>
                        <select class="form-control bg-light border-0 small" name="client_id" id="select_client">
                            @foreach ($client as $item => $value)
                            <option value="{{$value->client_id}}">{{$value->client_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <label class="m-0 font-weight-bold text-primary">Project Start</label>
                        <input name="project_start" type="date" class="form-control bg-light border-0 small" placeholder="Search for Project"
                        aria-label="Search" aria-describedby="basic-addon2" required>
                    </div>
                    <div class="col">
                        <label class="m-0 font-weight-bold text-primary">Project End</label>
                        <input name="project_end" type="date" class="form-control bg-light border-0 small" placeholder="Search for Project"
                        aria-label="Search" aria-describedby="basic-addon2" required>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <label class="m-0 font-weight-bold text-primary">Status</label>
                        <select class="form-control bg-light border-0 small" name="project_status" id="select_status">
                            <option value="OPEN">OPEN</option>
                            <option value="DOING">DOING</option>
                            <option value="DONE">DONE</option>
                        </select>
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
                <input type="hidden" name="delete_project_id" class="form-control">
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
            ordering: false,
            responsive: true,
            processing: true,
            serverSide: true,
            saveState: true,
            searching: false,
            ajax: {
                url: '{{ route('datatables') }}',
                data: function ( d ) {
                    d.project_filter = $('#project_filter').val();
                    d.client_filter = $('#client_filter').val();
                    d.project_status_filter = $('#project_status_filter').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false },
                { data: 'checkbox', searchable: false },
                { data: 'actions', searchable: false },
                { data: 'project_name', name: 'project_name' },
                { data: 'client_name', name: 'client_name' },
                { data: 'project_start', name: 'project_start' },
                { data: 'project_end', name: 'project_end' },
                { data: 'project_status', name: 'project_status' },
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
            $('#project_filter').val(null);
            $('#client_filter').val('');
            $('#project_status_filter').val('');
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
        
        $('#delete').on('click', function () {
            let id = [];
            $('input[name="id"]:checked').each(function() {
                id.push(this.value);
            });
            if(id.length>0){
                $('#deleteModal').modal('show');
                $("input[name='delete_project_id']").val(id);
            }
        });

        $('#create').click(function(e){
            $('#myModal').modal('show');
        });

        $('#dataTable').on('click', '#update', function (e) {
            $('#myModal').modal('show');
            $("input[name='project_name']").val($(this).data('name'));
            $("#select_client").val($(this).data('client')).change();
            $("input[name='project_start']").val($(this).data('start'));
            $("input[name='project_end']").val($(this).data('end'));
            $("#select_status").val($(this).data('status')).change();
            $("input[name='project_id']").val($(this).data('id'));
        });


        $('#myModal').on('hidden.bs.modal', function () {
            $("input[name='project_id']").val($(this).data('id'));
            $('#form')[0].reset();
        });

        $("#submitdelete").click(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let id = $("input[name='delete_project_id']").val();
            
            e.preventDefault();
                $.ajax({
                type: "DELETE",
                url: '{{route("product_crud")}}',
                data: {
                    id:id,
                },
                // processData: false,
                // contentType: false,
                success: function (data) {
                    console.log(data);
                    $('#dataTable').DataTable().ajax.reload();
                    $('#deleteModal').modal('hide');
                    $("input[name='delete_project_id']").val(null);
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
                url: '{{route("product_crud")}}',
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