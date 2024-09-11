<!-- Modal Import Employees -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Employees</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Download the CSV example file to see the format required for importing employees.</p>
                    <a href="{{ asset('files/employee_example.csv') }}" class="btn btn-info mb-3">Download Example CSV</a>

                    <form action="{{ route('employee.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="csv_file">Upload CSV File</label>
                            <input type="file" class="form-control-file" id="csv_file" name="csv_file" accept=".csv" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Import Employees</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>