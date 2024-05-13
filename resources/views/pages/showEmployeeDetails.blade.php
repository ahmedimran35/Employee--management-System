<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Showing All Employee Data</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navigation')
    <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-bordered border-primary">
                <thead class="table-primary">
            <tr>
                <th scope="col">Employee ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Image</th>
                <th scope="col">Address</th>
                <th scope="col">Contact Number</th>
                <th scope="col">NID Number</th>
                <th scope="col">Email</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Position Title</th>
                <th scope="col">Department</th>
                <th scope="col">Start Date</th>
                <th scope="col">Employment Status</th>
                <th scope="col">Work Location</th>
                <th scope="col">Salary</th>
                <th scope="col">Site Manager's Name</th>
                <th scope="col">Manager's Contact</th>
                <th scope="col">Invoice</th>

            </tr>
        </thead>
        <tbody>
            @foreach($employeeData as $employee)
            <tr>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->full_name }}</td>
                <td>
                    <img src="{{ asset('assets/images/' . $employee->image) }}" alt="Image" width="50" height="50">
                </td>
                <td>{{ $employee->address }}</td>
                <td>{{ $employee->contact_number }}</td>
                <td>{{ $employee->nid_number }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->date_of_birth }}</td>
                <td>{{ $employee->position_title }}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->start_date }}</td>
                <td>{{ $employee->employment_status }}</td>
                <td>{{ $employee->work_location }}</td>
                <td>{{ $employee->salary }}</td>
                <td>{{ $employee->site_manager_name }}</td>
                <td>{{ $employee->manager_contact }}</td>
                <td><a href="{{ route('pages.invoice', $employee->id)}}" class="btn btn-sm btn-secondary">Invoice</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>


   

</div>
</div>
</body>
</html>