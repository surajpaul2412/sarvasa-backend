<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::latest()->paginate(10);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function create()
    {
        return view('admin.enquiries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'loan_amt' => 'required|numeric|min:0',
            'stage' => 'required|string|max:255',
        ]);

        Enquiry::create($request->all());

        return redirect()->route('enquiries.index')->with('success', 'Enquiry created successfully.');
    }

    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return view('admin.enquiries.edit', compact('enquiry'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'location' => 'required|string|max:255',
            'loan_amt' => 'required|numeric|min:0',
            'stage' => 'required|string|max:255',
        ]);

        $enquiry = Enquiry::findOrFail($id);
        $enquiry->update($request->all());

        return redirect()->route('enquiries.index')->with('success', 'Enquiry updated successfully.');
    }

    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('enquiries.index')->with('success', 'Enquiry deleted successfully.');
    }

    public function updateStage(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:enquiries,id',
            'stage' => 'required|string|max:255',
        ]);

        $enquiry = Enquiry::findOrFail($request->id);
        $enquiry->stage = $request->stage;
        $enquiry->save();

        return response()->json(['success' => true, 'message' => 'Stage updated successfully.']);
    }


    // API
    public function storeEnquiry(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'mobile' => 'required|string|max:15|unique:enquiries,mobile',
                'location' => 'required|string|max:255',
                'loan_amt' => 'required|numeric|min:0',
                'stage' => 'required|string|max:255',
            ]);

            // Create the enquiry
            $enquiry = Enquiry::create($validatedData);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Enquiry created successfully.',
                'data' => $enquiry,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return a validation error response
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Return a general error response
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
