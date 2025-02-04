@extends('layouts.dashboard')

@section('breadcrum')
Gold Rate
@endsection

@section('style')
@endsection

@section('content')

@include('topmessages')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <form method="get" action="">
      <div style="display:inline-flex;margin-right:10px;">
        <input type="date" class="form-select" name="sel_from_date" placeholder="From Date" style="margin-right:10px;" value="2024-12-31"/>
        <input type="date" class="form-select" name="sel_to_date" placeholder="To Date" value="2024-12-31"/>
      </div>

      <button type="submit" class="btn btn-primary" title="Search">
        <i class="ri-search-line"></i> Search
      </button>
    </form>

    <div class="d-flex align-items-center gap-2 mt-3 mt-md-0">
        <!-- Raise Ticket Button -->
        <a type="button" href="#" class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#goldRateModal">
            <i class="ri-bar-chart-2-line fs-18 lh-1"></i><span class="d-none d-sm-inline">Add Gold rate</span>
        </a>
    </div>
</div>

<div class="row justify-content-center g-3">
    <div class="col-xl-12">
        <div class="row g-3">
            <div class="col-12 col-md-12 col-xl-12 pt-3">
                <div class="card card-one card-product text-center">
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Gold Rate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($goldRates->count())
                                @foreach ($goldRates as $index => $goldRate)
                                <tr>
                                    <td>{{$index + 1}}.</td>
                                    <td>{{$goldRate->date}}</td>
                                    <td>{{$goldRate->rate}}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="#" title="Edit" data-bs-toggle="modal" data-bs-target="#editGoldRateModal" 
                                           data-id="{{$goldRate->id}}" data-date="{{$goldRate->date}}" data-rate="{{$goldRate->rate}}">
                                            <i class="ri-pencil-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="12" style="text-align:center">
                                        No Data Found
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center my-3">
                            {{ $goldRates->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- col -->
</div><!-- row -->

<!-- Create Gold Rate Modal -->
<div class="modal fade" id="goldRateModal" tabindex="-1" aria-labelledby="goldRateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('goldRate.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="goldRateModalLabel">Create New Gold Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="date" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Gold Rate</label>
                        <input type="number" step="0.01" name="rate" class="form-control" id="rate" placeholder="price /gm" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Gold Rate Modal -->
<div class="modal fade" id="editGoldRateModal" tabindex="-1" aria-labelledby="editGoldRateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('goldRate.update', ['id' => 0]) }}" id="editGoldRateForm">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editGoldRateModalLabel">Edit Gold Rate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit-date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="edit-date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-rate" class="form-label">Gold Rate</label>
                        <input type="number" step="0.01" name="rate" class="form-control" id="edit-rate" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fill the edit modal with data
    document.addEventListener('DOMContentLoaded', () => {
        const editModal = document.getElementById('editGoldRateModal');
        editModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const date = button.getAttribute('data-date');
            const rate = button.getAttribute('data-rate');
            
            // Update form fields
            const form = document.getElementById('editGoldRateForm');
            form.action = `{{ url('admin/gold-rates') }}/${id}`;
            document.getElementById('edit-date').value = date;
            document.getElementById('edit-rate').value = rate;
        });
    });
</script>

@endsection

@section('script')
<script>
    // Function to set today's date in the input field
    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('date');
        const today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        dateInput.value = today; // Set the value of the input field
    });
</script>
@endsection
