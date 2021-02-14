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

      @if(Session::has('failed'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Student not found or student already timed in for the subject.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Attendance successfully recorded.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

      <div style="width: 500px;" id="reader"></div>

      <form method="post" action="{{ route('scan.insert') }}">
                @csrf
      <div class="row">

        <div class="col-lg-6">
           <label for="exampleInputEmail1"><font style="color:red;">* </font>Class</label>
           <select class="form-control" id="class" name="class" required>
              <option value="" selected disabled>Select Class</option>
              @foreach ($classes as $element)
                <option value="{{ $element['id'] }}">{{ $element['getGrade']->grade_level }} - {{ $element['getSection']->section }} - {{ $element['subject'] }} - {{ $element['time_start'] }} - {{ $element['time_end'] }}</option>
              @endforeach
            </select>
        </div>

        <div class="form-group">
           <label for="exampleInputEmail1"><font style="color:red;">*</font>Unique ID</label>
          <input type="text" class="form-control" placeholder="Enter ID" name="student_id" id="generator_id" readonly required>
        </div>

        {{-- <div class="form-group">
           <label for="exampleInputEmail1"><font style="color:red;">*</font>Full Name</label>
          <input type="text" class="form-control" placeholder="Enter Name" name="full_name" id="full_name" readonly>
        </div> --}}
        <div class="form-group">
          <button type="submit" class="btn btn-success ">Mark as Present</button>
        </div>
      </div>
    </form>
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
 let classes =  document.getElementById('class').value;

 if(classes == ''){
   Toast.fire({
      icon: 'warning',
      title: 'Please select class first.'
    })

   return false;
 }
 document.getElementById('generator_id').value = qrCodeMessage;

 if(document.getElementById('generator_id').value == ''){
   Toast.fire({
      icon: 'warning',
      title: 'Invalid QR.'
    })

   return false;
 }
 seearchStudent(qrCodeMessage,classes);
}

var html5QrcodeScanner = new Html5QrcodeScanner(
  "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);


function seearchStudent(student_id,clases){
  $.ajax({
        type: "get",
        url:"{{ route('scan.search.student') }}",
        cache:false,
        data:{ student_id: student_id , clases : clases },
        success:function(data)
        {
            // location.reload();
            if(data == 1)
            {

               Toast.fire({
                icon: 'success',
                title: 'Student Found please click mark as present to proceed.'
              })
            }

            else

            {
              Toast.fire({
                icon: 'warning',
                title: 'Student Not found on this class.'
              })

               document.getElementById('generator_id').value = '';
            }
        }
    });
}



  </script>

@endsection
