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
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Entry Time</th>
                    <th>Exit Time</th>
                    <th>Late In</th>
                    <th>Early Out</th>
                    <th>Remarks</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Hidden input field to store the current date -->
                <input type="hidden" id="date" name="date">
                <input type="hidden" id="user_id" name="user_id">
                
                @foreach($dates as $date)
                 <tr>
                    <td>{{ $date }}</td>
                    <td><input type="time" class="form-control" id="entryTime" name="entryTime" value=""></td>
                    <td><input type="time" class="form-control" id="exitTime" name="exitTime" value=""></td>
                    <td><input type="text" class="form-control late-in" readonly></td>
                    <td><input type="text" class="form-control early-out" readonly></td>
                    <td>
                        <div class="input-group">
                        <input type="text" class="form-control remarks" >
                        <button type="button" class="btn btn-outline-secondary remarksBtn" data-date="{{ $date }}"
                         data-bs-toggle="modal" data-bs-target="#remarksModal{{ $loop->index }}">
                         <i class="bi bi-pencil-fill"></i>
                        </button>
                        </div>
                    </td>
                    <td>
                        @php
                        // Fetch attendance record for the current date and the logged-in user
                        $attendanceRecord = App\Models\AttendanceRecord::where('date', $date)
                            ->where('user_id', Auth::id())
                            ->first();
                        @endphp
                    @if($attendanceRecord)
                        @if($attendanceRecord->status == '1')
                            <span class="badge bg-success">Approved</span>
                        @elseif($attendanceRecord->status == '2')
                            <span class="badge bg-danger">Rejected</span>
                        @else
                            <span class="badge bg-secondary text-light">Pending</span>
                        @endif
                    @else
                        <!-- if attendance record doesn't exist for the current date -->
                        <span class="badge bg-light text-dark">Not Available</span>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<!-- Modal -->
@foreach($dates as $index => $date)
<div class="modal fade" id="remarksModal{{ $index }}" tabindex="-1" aria-labelledby="remarksModalLabel{{ $index }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksModalLabel{{ $index }}">Add Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="remarksForm" action="{{ route('attendance.store') }}" method=POST>
                @csrf
                <input type="hidden" class="form-control" name="date" value="{{ $date }}">
                <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="entryTime" class="form-label">Entry Time</label>
                        <input type="time" class="form-control" id="entryTime" name="entryTime">
                    </div>
                    <div class="mb-3">
                        <label for="exitTime" class="form-label">Exit Time</label>
                        <input type="time" class="form-control" id="exitTime" name="exitTime">
                    </div>
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <input type="text" class="form-control" id="remarks" name="remarks">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Bootstrap JS and other scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
