<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
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
        .success-btn{
           
            border-radius: 6px;
            box-sizing: border-box;
            color: #58c243e6;
            font-size: 15px;
            font-weight: 600;
            padding: 6px 16px;
            position: relative;
            vertical-align: middle;

        }
        .danger-btn{
            
            border-radius: 6px;
            box-sizing: border-box;
            color: #c31720e6;
            font-size: 15px;
            font-weight: 600;
            padding: 6px 10px;
            position: relative;
            vertical-align: middle;
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
        <div class="responsive-table">
            <table class="table table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Entry Time</th>
                        <th>Exit Time</th>
                        <th>Remarks</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userData as $record)
                        <tr>
                            <td>{{ $record->date }}</td>
                            <td>{{ $record->user->name }}</td>
                            <td>{{ $record->entryTime }}</td>
                            <td>{{ $record->exitTime }}</td>
                            <td>{{ $record->remarks }}</td>
                    
                            <td><form action="{{ route('attendance.approve', $record->id) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm success-btn">Approve</button>
                                </form>
                                <form action="{{ route('attendance.reject', $record->id) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm danger-btn">Decline</button>
                                 </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>