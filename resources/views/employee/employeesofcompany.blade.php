<!DOCTYPE html>
<html>
<head>
  <title>Employees</title>

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
      <h2>Employees</h2>
      
    </div>

    <div class="card-body">

        <table class="table table-bordered" id="datatables-example">
           <thead>
              <tr>
                 <th>Image</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Company</th>
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
           ajax: "{{ route('employee.index') }}",
           columns: [
                    { data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'company', name: 'company' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                 ]
       });
    });
</script>
</div>  
</body>
</html>
