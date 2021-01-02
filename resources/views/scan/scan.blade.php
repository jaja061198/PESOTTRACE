@extends('layouts.app')

@section('header-assets')
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
 <script src="{{ asset('plugins/qr.min.js') }}"></script>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Scan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Scan</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div style="width: 500px" id="reader"></div>
    </div>
    <!-- /.content -->
  </div>



{{-- ADD MODAL  --}}
 <div class="modal fade" id="modal-lg-add" wire:ignore.self data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
            <p> Add Grade </p>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <div class="form-group row">
            <label for="add_fname" class="col-sm-2 col-form-label">Grade Level</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="grade_add" name="fname" placeholder="Grade Level" required>
              <input type="hidden" name="" id="grade_id">
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" id="add" onclick="insertUser()">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




{{-- EDIT MODAL  --}}
 <div class="modal fade" id="modal-lg-edit" wire:ignore.self data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
            <p> Edit Grade </p>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <div class="form-group row">
            <label for="add_fname" class="col-sm-2 col-form-label">Grade Level</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="grade_edit" name="grade_edit" placeholder="Grade Level" required>
            </div>
          </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" id="edit" onclick="updateData()">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection


@section('footer-assets')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    window.addEventListener('openEditModal', event => {
      $('#modal-lg').modal('show');
      // Toast.fire({
      //   icon: 'success',
      //   title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      // })

    });

    // window.addEventListener('closeEditModal', event => {
    //   $('#modal-lg').modal('hide');
    // });

    // window.addEventListener('openAddModal', event => {
    //   $('#modal-lg-add').modal('show');
    // });

    // window.addEventListener('closeAddModal', event => {
    //   $('#modal-lg-add').modal('hide');
    // });


    // window.addEventListener('successToastInsert', event => {
    //   Toast.fire({
    //     icon: 'success',
    //     title: 'Insert Success.'
    //   })
    // })

    // window.addEventListener('successToastUpdate', event => {
    //   Toast.fire({
    //     icon: 'success',
    //     title: 'Update Success.'
    //   })
    // })

function onScanSuccess(qrCodeMessage) {
  // handle on success condition with the decoded message
  console.log(qrCodeMessage);
}

var html5QrcodeScanner = new Html5QrcodeScanner(
  "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);





  </script>

@endsection
