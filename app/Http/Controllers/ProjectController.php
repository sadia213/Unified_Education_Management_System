<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Add your logic here for retrieving project details and displaying them
        return view('admin.pages.student.project_submission.index');
    }

    public function create()
    {
        return view('admin.pages.student.project_submission.create');
    }

    public function store(Request $request)
    {
        try {
            // Retrieve user_id and department_id from session
            $user_id = session('user_id');
            $department_id = session('user_department_id');

            // Check if the user has already submitted a project
            if (ProjectDetail::where('user_id', $user_id)->exists()) {
                return back()->withErrors(['user_id' => 'You have already submitted a project.']);
            }

            // Validate form input
            $validatedData = $request->validate([
                'project_title' => 'required|max:255',
                'project_details' => 'required',
                'member_1_name' => 'required|max:255',
                'member_1_id' => 'required|max:20',
                'member_2_name' => 'nullable|max:255',
                'member_2_id' => 'nullable|max:20',
                'member_3_name' => 'nullable|max:255',
                'member_3_id' => 'nullable|max:20',
                'member_4_name' => 'nullable|max:255',
                'member_4_id' => 'nullable|max:20',
            ]);

            // Create a new ProjectDetail instance
            $projectDetail = new ProjectDetail();

            // Assign values to the attributes
            $projectDetail->user_id = $user_id;
            $projectDetail->department_id = $department_id;
            $projectDetail->project_title = $validatedData['project_title'];
            $projectDetail->project_details = $validatedData['project_details'];
            $projectDetail->member_1_name = $validatedData['member_1_name'];
            $projectDetail->member_1_id = $validatedData['member_1_id'];
            $projectDetail->member_2_name = $validatedData['member_2_name'];
            $projectDetail->member_2_id = $validatedData['member_2_id'];
            $projectDetail->member_3_name = $validatedData['member_3_name'];
            $projectDetail->member_3_id = $validatedData['member_3_id'];
            $projectDetail->member_4_name = $validatedData['member_4_name'];
            $projectDetail->member_4_id = $validatedData['member_4_id'];

            // Save the project detail
            $projectDetail->save();

            return back()->with('success', 'Project idea submitted successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error($e->getMessage());
            return back()->withErrors(['error' => 'An error occurred. Please try again later.']);
        }
    }
}
