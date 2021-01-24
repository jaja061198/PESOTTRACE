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

      <div class="form-group">
      <input type="text" class="form-control" name="" id="generator_id" placeholder="Unique Key" readonly>

      <input type="text" class="form-control" name="" id="generator_id" placeholder="Full Name" readonly> 

      <button type="button" class="btn btn-success ">Mark as Present</button>
      </div>
    </div>
    <!-- /.content -->
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
 // alert(qrCodeMessage);
 document.getElementById('generator_id').value = qrCodeMessage;
}

var html5QrcodeScanner = new Html5QrcodeScanner(
  "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);


  </script>

@endsection
