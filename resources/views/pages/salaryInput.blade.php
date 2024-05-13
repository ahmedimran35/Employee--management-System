<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Salary Input</title>
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
        function getMonthlySalary(employee_id) {
            
            // AJAX request to fetch the salary amount of the selected employee
        
            $.ajax({
                url: "{{ route('get-salary', ':employee_id') }}".replace(':employee_id', employee_id),
                type: 'GET',
                success: function(response) {
                   
                    $('#monthly_salary').val(response.monthly_salary);
                    
                }
            });
        }
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
       
        <div class="text-center"><h2>Monthly Salary Input</h2></div>
        <form action="{{ route('salary.store') }}" method="POST">
            @csrf
          
            <div class="mb-3">
                <label for="employee_id" class="form-label">Name:</label>
                <select class="form-control" id="employee_id" name="employee_id" onchange="getMonthlySalary(this.value)" >
                    <option value="">Select Employee</option>
                    @foreach($employeeData as $employee_id => $employeeName)
                        <option value="{{ ($employee_id) }}">{{ $employeeName}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="monthly_salary" class="form-label">Salary Amount:</label>
                <input type="number" class="form-control" id="monthly_salary" name="monthly_salary" required >
            </div>

            <div class="mb-3">
                <label for="month" class="form-label">Month:</label>
                <select class="form-control" id="month" name="month" required>
                    <option value="">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year:</label>
                <input type="number" class="form-control" id="year" name="year" required>
            </div>
            
            <button type="submit" class="btn">Submit</button>
    
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
