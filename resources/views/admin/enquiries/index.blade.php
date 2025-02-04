@extends('layouts.dashboard')

@section('breadcrum')
Enquiries
@endsection

@section('style')
@endsection

@section('content')

@include('topmessages')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <form method="get" action="">
        <div style="display:inline-flex;margin-right:10px;width: 400px;">
            <input class="form-control" type="text" name="search" placeholder="search by name, mob, location, loan amt & stage">
        </div>

        <button type="submit" class="btn btn-primary" title="Search">
            <i class="ri-search-line"></i> Search
        </button>
    </form>
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
                                    <th>Full Name</th>
                                    <th>Mobile No.</th>
                                    <th>Location</th>
                                    <th>Loan Amt</th>
                                    <th>Stage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($enquiries->count())
                                @foreach ($enquiries as $index => $enquiry)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>{{ $enquiry->full_name }}</td>
                                    <td>{{ $enquiry->mobile }}</td>
                                    <td>{{ $enquiry->location }}</td>
                                    <td>{{ $enquiry->loan_amt }}</td>
                                    @php
									    // Map stages to colors
									    $stageColors = [
									        'Fresh Lead' => 'yellow',
									        'Not Interested' => 'red',
									        'Converted' => 'green',
									        'Follow Up' => 'blue',
									    ];

									    // Get the background color for the current stage, default to transparent
									    $backgroundColor = $stageColors[$enquiry->stage] ?? 'transparent';
									@endphp
                                    <td style="background: {{ $backgroundColor }};">
									    <select class="update-stage" data-id="{{ $enquiry->id }}" style="background: transparent;">
									        <option value="Fresh Lead" {{ $enquiry->stage == 'Fresh Lead' ? 'selected' : '' }}>Fresh Lead</option>
									        <option value="Not Interested" {{ $enquiry->stage == 'Not Interested' ? 'selected' : '' }}>Not Interested</option>
									        <option value="Converted" {{ $enquiry->stage == 'Converted' ? 'selected' : '' }}>Converted</option>
									        <option value="Follow Up" {{ $enquiry->stage == 'Follow Up' ? 'selected' : '' }}>Follow Up</option>
									    </select>
									</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="12" style="text-align:center">
                                        No enquiry Found
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center my-3">
                            {{ $enquiries->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- col -->
</div><!-- row -->

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.update-stage').forEach(function (dropdown) {
            dropdown.addEventListener('change', function () {
                const td = this.closest('td');
                const stage = this.value;

                // Update the background color based on the selected stage
                if (stage === 'Fresh Lead') {
                    td.style.background = 'yellow';
                } else if (stage === 'Not Interested') {
                    td.style.background = 'red';
                } else if (stage === 'Converted') {
                    td.style.background = 'green';
                } else if (stage === 'Follow Up') {
                    td.style.background = 'blue';
                } else {
                    td.style.background = 'transparent';
                }

                // Perform your AJAX call here to update the stage in the database
                fetch(`{{ url('admin/enquiries/update-stage') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: this.dataset.id,
                        stage: stage
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Stage updated successfully.');
                    } else {
                        alert('Failed to update stage.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
            });
        });
    });
</script>
@endsection
