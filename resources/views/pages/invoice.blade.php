<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        
        
        .invoice-id{
            font size: 15px;

        }
        .details {
            display: flex;   
            justify-content: flex-start;
            margin-bottom: 20px;
        }
        
        .products {
            margin-bottom: 20px;
        }
        .products table {
            width: 100%;
            border-collapse: collapse;
        }
        .products th, .products td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .products th {
            background-color: #f2f2f2;
        
        }
        .footer {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="assets/companyLogo.png" alt="Company Logo" height="100" width="100">
            </div>
            <div class="invoice-id">
                    <h4>Invoice ID: #######</h4>
                    <h4>Date: {{ $date }}</h4>
            </div>
        </div>
    
        <div class="details">
            <div class="details-col">
            <div>{{$employeeData->full_name}}</div>
            <div>Address: {{$employeeData->address}}</div>
            </div>
            <div class="details-col">
            <div>Phone: {{$employeeData->contact_number}}</div>
            <div>Email: {{$employeeData->email}}</div>
            </div>
        </div>

        <div class="products">
            <table>
                <thead>
                    <tr>
                        <th>Sl.</th>
                        <th>Description</th>
                        <th>Month</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Monthly Salary</td>
                        <td>Feb</td>
                        <td>{{$employeeData->salary}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total:</strong></td>
                        <td><strong>Tk. {{$employeeData->salary}}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="footer">
            <p>Thank you for your support<br>Blue Sail Company</p>
        </div>
    </div>
</body>
</html>
