@extends('layouts.dashboard')

@section('breadcrum')
Gold Rate
@endsection

@section('style')
<!-- Add Bootstrap CSS if not already included -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')

@include('topmessages')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <form method="get" action="">
      <div style="display:inline-flex;margin-right:10px;">
        <select class="form-select mx-2" name="sel_status_id" style="width:130px;">
            <option value="">All Status</option>
            <option value="1">Order Initiated</option>
            <option value="2">Order Check</option>
            <option value="3">Fund Remitted</option>
            <option value="4">Share Transfer</option>
            <option value="5">ETF Transfer</option>
            <option value="6">Mail to AMC</option>
            <option value="7">Order Received</option>
            <option value="8">Order Executed</option>
            <option value="9">Deal Slip Received</option>
            <option value="10">ETF Transfer 1+1</option>
            <option value="11">Refund Received</option>
            <option value="12">Redemption Received</option>
            <option value="13">Units Received</option>
            <option value="14">Shares Received</option>
        </select>
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
            <i class="ri-bar-chart-2-line fs-18 lh-1"></i><span class="d-none d-sm-inline">Raise Ticket</span>
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
                                <tr>
                                    <td>1</td>
                                    <td>31-12-2024</td>
                                    <td>5000.00</td>
                                    <td>
                                        <a href="#" title="Edit">
                                            <i class="ri-pencil-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="12" style="text-align:center">
                                        No Data Found
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        {{--<div class="d-flex justify-content-center my-3">
                            {{ $tickets->withQueryString()->links() }}
                        </div>--}}
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div><!-- col -->
</div><!-- row -->

<!-- Gold Rate Modal -->
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
                        <input type="date" name="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Gold Rate</label>
                        <input type="number" step="0.01" name="rate" class="form-control" id="rate" required>
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

<form id="toggleStatusForm" style="display:none">
    <input name="item" value="">
    <input name="action" value="togglestatus">
</form>

<script>
    var base_url = "/admin/tickets";
</script>
@endsection

@section('script')
<!-- Add Bootstrap JS if not already included -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
