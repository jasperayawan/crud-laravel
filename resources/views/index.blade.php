<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    {{-- add new employee modal start --}}
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
      @csrf
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
          </div>
          <div class="col-lg">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
          </div>
        </div>
        <div class="my-2">
          <label for="email">E-mail</label>
          <input type="email" name="email" class="form-control" placeholder="E-mail" required>
        </div>
        <div class="my-2">
          <label for="phone">Phone</label>
          <input type="tel" name="phone" class="form-control" placeholder="Phone" required>
        </div>
        <div class="my-2">
          <label for="post">Post</label>
          <input type="text" name="post" class="form-control" placeholder="Post" required>
        </div>
        <div class="my-2">
          <label for="avatar">Select Avatar</label>
          <input type="file" name="avatar" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="add_employee_btn" class="btn btn-primary">Add Employee</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="#" method="POST" id="edit_employee_form" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="emp_id" id="emp_id">
      <input type="hidden" name="emp_avatar" id="emp_avatar">
      <div class="modal-body p-4 bg-light">
        <div class="row">
          <div class="col-lg">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
          </div>
          <div class="col-lg">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
          </div>
        </div>
        <div class="my-2">
          <label for="email">E-mail</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required>
        </div>
        <div class="my-2">
          <label for="phone">Phone</label>
          <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" required>
        </div>
        <div class="my-2">
          <label for="post">Post</label>
          <input type="text" name="post" id="post" class="form-control" placeholder="Post" required>
        </div>
        <div class="my-2">
          <label for="avatar">Select Avatar</label>
          <input type="file" name="avatar" class="form-control">
        </div>
        <div class="mt-2" id="avatar">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
      </div>
    </form>
  </div>
</div>
</div>
{{-- edit employee modal end --}}

<div class="container">
  <div class="row my-5">
    <div class="col-lg-12">
      <div class="card shadow">
        <div class="card-header bg-success d-flex justify-content-between align-items-center">
          <h3 class="text-light">Manage Employees</h3>
          <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
              class="bi-plus-circle me-2"></i>Add New Employee</button>
        </div>
        <div class="card-body" id="show_all_employees">
          <h1 class="text-center text-secondary my-5">Loading...</h1>
        </div>
      </div>
    </div>
  </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        // fetch all employees ajax request
        function fetchAllEmplyees(){
            $.ajax({
                url: '{{ route('fetchAll') }}',
                method: 'get',
                success: function(res){
                    $("#show_all_employees").html(res);

                    // let's use datatables

                    $("table").DataTable({
                      order: [0, 'desc']
                    })
                }
            })
        }

        fetchAllEmplyees();

        //add new employee ajax requedt

        $("#add_employee_form").submit(function(e){
            e.preventDefault();

            const formData = new FormData(this);
            $("#add_employee_btn").text('Adding...');

            $.ajax({
                url: '{{ route('store') }}',
                method: 'post',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res){
                    if(res.status === 200){
                        // add sweet alert 
                        swal.fire(
                            'Added!',
                            'Employee Added Successfully!',
                            'success'
                        )
                        //get the fetchallEmployees function to display automatically data employee to table
                        fetchAllEmplyees();
                    }

                    $("#add_employee_btn").text('Add Employee');
                    $("#add_employee_form")[0].reset();
                    $("#addEmployeeModal").modal('hide');
                }
            });
        })

        // edit employee ajax request
        $(document).on('click', '.editIcon', function(e){
              e.preventDefault();

              let id = $(this).attr('id');
              $.ajax({
                url: '{{ route('edit') }}',
                method: 'get',
                data: {
                  id: id,
                  _token: '{{ csrf_token() }}'
                },
                success: function(res){
                  // set all the previous values into this input field which is the edit form
                  $("#fname").val(res.first_name);
                  $("#lname").val(res.last_name);
                  $("#email").val(res.email);
                  $("#phone").val(res.phone);
                  $("#post").val(res.post);
                  $("#avatar").html(`<img src="storage/images/${res.avatar}" width="100
                  class="img-fluid img-thumbnail"/>`);
                  $("#emp_id").val(res.id);
                  $("#emp_avatar").val(res.avatar);
                }
              })
        })

        // update employee ajax request

        $("edit_employee_form").submit(function(e){
          e.preventDefault();

          const formData = new FormData(this);
          $("edit_employee_btn").text('Updating...');
          $.ajax({
            url: '{{ route('update') }}',
            method: 'post',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(res){
              console.log(res)
            }
          })
        })
    </script>
</body>
</html>