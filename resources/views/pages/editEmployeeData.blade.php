<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa; 
            color: #343a40; 
        }
        .container {
            max-width: 600px; 
            margin: 0 auto; /* Center align the form */
            padding: 30px;
            background-color: #fff; 
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .secondary-caption {
            color:  #4bb7b3;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            
        }
        .btn {
                background-color: #f5f7f9;
                border: 1px solid #778b93d2;
                border-radius: 6px;
                box-shadow: rgba(27, 31, 35, 0.04) 0 1px 0, rgba(30, 23, 23, 0.25) 0 1px 0 inset;
                box-sizing: border-box;
                color: #383c41;
                font-size: 15px;
                font-weight: 600;
                padding: 6px 16px;
                position: relative;
                vertical-align: middle;
            }
        @media (max-width: 768px) {
        .container {
        padding: 20px;}
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        function getEmployeeInfo(employee_id) {
            
            $('#employee_id').val(employee_id);
            // AJAX request to fetch the all data of the selected employee
        
            $.ajax({
                url: "{{ route('get-info', ':employee_id') }}".replace(':employee_id', employee_id),
                type: 'GET',
                success: function(response) {
                    console.log(response);
                   
                    $('#address').val(response.address);
                    $('#contact_number').val(response.contact_number);
                    $('#nid_number').val(response.nid_number);
                    $('#email').val(response.email);
                    $('#date_of_birth').val(response.date_of_birth);
                    $('#position_title').val(response.position_title);
                    $('#department').val(response.department);
                    $('#start_date').val(response.start_date);
                    $('#work_location').val(response.work_location);
                    $('#salary').val(response.salary);
                    $('#employment_status').val(response.employment_status);
                    $('#site_manager_name').val(response.site_manager_name);
                    $('#manager_contact').val(response.manager_contact);

                    $('#image-preview').attr('src', response.image);

                   }
            });
        }
        
        $('#employee_id').change(function() {
        var employee_id = $(this).val();
        if (employee_id !== '') {
            getEmployeeInfo(employee_id);}
            });

            // Function to preview image before upload
            $("#image").change(function(){
                readURL(this);
            });

            function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }}
        });
    </script>
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navigation')
    <div class="container mt-3 mb-3">
        <div class="text-center"><h2>Employee Information Form</h2></div>

        <form action="{{ route('employee.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
            <label for="employee_id" class="form-label">Name:</label>
                <select class="form-control" id="employee_id" name="employee_id" onchange="getEmployeeInfo(this.value)">
                    <option value="">Select Employee</option>
                    @foreach($employeeData as $employee_id => $employeeName)
                        <option value="{{ ($employee_id) }}">{{ $employeeName}}</option>
                        
                    @endforeach
                </select>
            </div>

            <div class="secondary-caption text-center"><h2>Personal Information</h2></div>

            

            <!-- Personal information fields -->
            <div class="row">
                <div class="col-md-6">
                    
                        <div class="mb-3">
                            <label for="image" class="form-label">Employee Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                            
                        </div>
                        <div class="mb-3">
                            <!-- Image preview container -->
                            <img id="image-preview" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px;">
                        </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" >
                    </div>
                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact Number:</label>
                        <input type="number" class="form-control" id="contact_number" name="contact_number">
                    </div>
                </div>

                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nidNumber" class="form-label">NID Number:</label>
                        <input type="number" class="form-control" id="nid_number" name="nid_number">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth:</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" >
                    </div>
                </div>
            </div>

            <div class="secondary-caption text-center"><h2>Job Information</h2></div>

            <div class="mb-3">
                <label for="positionTitle" class="form-label">Position Title:</label>
                <input type="text" class="form-control" id="position_title" name="position_title">
            </div>

            <!-- Job information fields -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="department" class="form-label">Department:</label>
                        <input type="text" class="form-control" id="department" name="department" >
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date:</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" >
                    </div>
                    <div class="mb-3">
                        <label for="workLocation" class="form-label">Work Location:</label>
                        <select class="form-control" id="work_location" name="work_location" >
                            <option value="default">Select</option>
                            <option value="Uttara">Uttara</option>
                            <option value="Karwan Bazar">Karwan Bazar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="salary" class="form-label">Salary:</label>
                        <input type="number" class="form-control" id="salary" name="salary">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="employmentStatus" class="form-label">Employment Status:</label>
                        <select class="form-control" id="employment_status" name="employment_status" >
                            <option value="default">Select</option>
                            <option value="part-time">Part-time</option>
                            <option value="full-time">Full-time</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="siteManagerName" class="form-label">Site Manager's Name:</label>
                        <input type="text" class="form-control" id="site_manager_name" name="site_manager_name" >
                    </div>
                    <div class="mb-3">
                        <label for="managerContact" class="form-label">Manager's Contact:</label>
                        <input type="number" class="form-control" id="manager_contact" name="manager_contact" >
                    </div>
                </div>
            </div>

            

            <button type="submit" class="btn btn-primary">Save Edits</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
