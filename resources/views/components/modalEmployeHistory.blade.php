<!-- Modal History -->
@foreach($employees as $employee)
<div class="modal fade" id="historyModal-{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyModalLabel">Access History for {{ $employee->first_name }} {{ $employee->last_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="historyFilterForm-{{ $employee->id }}" class="mb-4">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" id="start_date-{{ $employee->id }}" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" id="end_date-{{ $employee->id }}" name="end_date">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="loadHistory({{ $employee->id }})">Filter</button>
                    <button type="button" class="btn btn-success" onclick="generatePdf({{ $employee->id }})">Generate PDF</button>
                </form>
                <div id="historyContent-{{ $employee->id }}">
                    <p>Loading history...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach