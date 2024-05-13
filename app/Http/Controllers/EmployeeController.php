<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use \Mpdf\Mpdf as PDF;

use File;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('salaries')->get();
        //dd($employees); exit();
        return view('pages.employeeIndex', compact('employees'));
    }
    public function salary_input()
    {
        //$employeeData = Employee::all();
        $employeeData = Employee::pluck('full_name', 'id');
        //dd(compact('employeeData'));
        return view('pages.salaryInput',compact('employeeData'));
        
    }
    public function input()
    {
        return view('pages.employeeDetails');
        
    }
    public function invoice($employee_id)
    {
 
        // Create the mPDF document
        $pdf = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);     

        //$employeeData= Employee::find($employee_id);
        $employeeData= Employee::with('salaries')->find($employee_id);
        //dd($employeeData);

        $date= Carbon::today()->toDateString();
        //dd($date);

        $pdf->WriteHTML(view('pages.invoice', compact('employeeData', 'date')));
        
        return $pdf->Output('invoice.pdf', 'I');
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =$request->validate([
        ]
        );
        //dd($validatedData); exit();
    
        $employeeData = [

            'employee_id' => $request->employee_id,
            'full_name' => $request->full_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'nid_number' => $request->nid_number,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
    
           
            'position_title' => $request->position_title,
            'department' => $request->department,
            'start_date' => $request->start_date,
            'employment_status' => $request->employment_status,
            'work_location' => $request->work_location,
            'salary' => $request->salary,
            'site_manager_name' => $request->site_manager_name,
            'manager_contact' => $request->manager_contact,

        ];
    
        
        if($request->image){

            $image = $request->file('image');
            $img = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = public_path('assets/images/'.$img);

            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->save($path);
        
            
            $employeeData['image']=$img;
        }
        
        //dd($employeeData); 
        $employee = new Employee;
        $employee->fill($employeeData);
        $employee->save();
    
    
            return redirect()->back();
    }

    public function salary_store(Request $request)
    {
        $salaryData = [
            'employee_id' => $request->employee_id,
            'monthly_salary' => $request->monthly_salary,
            'month'=> $request->month,
            'year'=> $request->year,
    ];
    
    //dd($salaryData); exit();
    $salary = new Salary;
    $salary->fill($salaryData);
    $salary->save();


        return redirect()->back();
}
    /**
     * Display the specified resource.
     */
    public function show()
    {

        $employeeData = Employee::all();
       
        return view('pages.showEmployeeDetails', compact('employeeData'));
    }

    public function getMonthlySalary($employee_id)
    {

        $employee = Employee::find($employee_id);
        
        return response()->json(['monthly_salary' => $employee->salary ]);
    }

    public function getEmployeeInfo($employee_id)
    {
        $employee = Employee::find($employee_id);
        
        return response()->json([
                                'image' => '/assets/images/' . $employee->image,
                                
                                'address' => $employee->address,
                                'contact_number'=> $employee->contact_number,
                                'nid_number'=> $employee->nid_number,
                                'email'=> $employee->email,
                                'date_of_birth'=> $employee->date_of_birth,
                                'position_title'=> $employee->position_title,
                                'department'=> $employee->department,
                                'start_date'=> $employee->start_date,
                                'employment_status'=> $employee->employment_status,
                                'work_location'=> $employee->work_location,
                                'salary'=> $employee->salary,
                                'site_manager_name'=> $employee->site_manager_name,
                                'manager_contact'=> $employee->manager_contact,
                             ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {   
        $employeeData = Employee::pluck('full_name', 'id');
        return view('pages.editEmployeeData', compact('employeeData'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function updateEmployee(Request $request) {
        

        $id = $request->input('employee_id');
        $employee = Employee::find($id);
        
        $employee->image = $request->input('image');       ///FIX
        $employee->address = $request->input('address');
        $employee->contact_number = $request->input('contact_number');
        $employee->nid_number = $request->input('nid_number');
        $employee->email = $request->input('email');
       
        $employee->position_title = $request->input('position_title');
        $employee->department = $request->input('department');

        $employee->employment_status = $request->input('employment_status');
        $employee->work_location = $request->input('work_location');
        $employee->salary = $request->input('salary');

        $employee->site_manager_name = $request->input('site_manager_name');
        $employee->manager_contact = $request->input('manager_contact');

        if(file($request->image)){
            
            if(File::exists('assets/images/'.$employee->image)){
                File::delete('assets/images/'.$employee->image);
            }

            $image = $request->file('image');
            $img = rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = public_path('assets/images/'.$img);

            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->save($path);
        
            
            $employee->image = $img;
            $dd=($employee->image);
        }

        // Update fields 
       
        $employee->save();
    
        return redirect()->back();

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    

    
}
