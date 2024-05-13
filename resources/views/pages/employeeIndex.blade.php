<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Overview</title>
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

    </style>
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body>
    @include('layouts.navigation')
    <div class="container mt-3 mb-3">
        <table class="table table-bordered border-primary">
            
    
        @foreach($employees as $employee)
            <tr><th colspan="3" style="text-align:center">{{ $employee->full_name }}</th></tr>
        <tr>
            <td scope="col" style="text-align:center">Salary Amount</td>
            <td scope="col"style="text-align:center">Month</td>
            <td scope="col" style="text-align:center">Year</td>
        </tr>
        <tr>
        @foreach($employee->salaries as $salary)
            <tr>
            <td>{{ $salary->monthly_salary}}</td>
            <td>{{ $salary->month }}</td>
            <td>{{ $salary->year }}</td>
            </tr>
            @endforeach
        </tr>
        @endforeach
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

