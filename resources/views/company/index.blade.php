<!DOCTYPE html>
<html>
<head>
  <title>Companies</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

</head>
<body>

<div class="container mt-4">

  <div class="card">

    <div class="card-header text-center font-weight-bold">
      <h2>Companies</h2>
      <a href="{{ route('company.create') }}"  id="btn-btn-create" class="btn btn-success pull-right modal-show"  title="Add New Company"><i class="fa fa-user-plus"></i> Add New Company</a>

    </div>

    <div class="card-body">

        <table class="table table-bordered" id="datatables-example">
           <thead>
              <tr>
                 <th>Name</th>
                 <th>address</th>
                 <th>logo</th>
                 <th>Actions</th>

              </tr>
           </thead>
        </table>

    </div>

  </div>
<script type="text/javascript">
     
 $(document).ready( function () {
    $('#datatables-example').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('company.index') }}",
           columns: [
                    { data: 'name', name: 'name' },
                    { data: 'address', name: 'address' },
                    { data: 'logo', name: 'logo' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                 ]
       });
    });
</script>
</div>  
</body>
</html>
