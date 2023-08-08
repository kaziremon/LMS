<script>
    $(document).ready(function() {
        $('#statusid').DataTable({
            "paging": false,
            "bInfo": false,
            dom: 'Bfrtip',
            "createdRow": function(row, data, index) {
                $('td', row).eq(1).addClass('wrap');
            },
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    messageTop: 'Date Wise Attendance Report',
                    filename: 'Date Wise Attendance Report'
                },
                {
                    extend: 'csv',
                    messageTop: 'Date Wise Attendance Report',
                    filename: 'Date Wise Attendance Report'
                },
                {
                    extend: 'pdf',
                    messageTop: 'Date Wise Attendance Report',
                    filename: 'Date Wise Attendance Report',
                    title: 'Date Wise Attendance Report',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'print',
                    title: function() {
                        return "<div style='font-size: 15px;text-align:center;'>Date Wise Attendance Report</div>";
                    }
                }
            ]
        });
    });
</script>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4>Date Wise Attendance Report</h4>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="table-responsive">
                <table id="statusid" class="table table-bordered">
                    <thead style="padding-bottom:20px;">
                        <tr style="font-weight:bold;">
                            <td style="font-size:15px;">#</td>
                            <td style="font-size:15px;"><strong>Date</strong></td>
                            <td style="font-size:15px;"><strong>Index No.</strong></td>
                            <td style="font-size:15px;"><strong>Trainee Name</strong></td>
                            <td style="font-size:15px;"><strong>Course Name</strong></td>
                            <td style="font-size:15px;"><strong>Vanue Name</strong></td>
                            <td style="font-size:15px;"><strong>Batch Name</strong></td>
                            <td style="font-size:15px;"><strong>Status</strong></td>
                        </tr>
                    </thead>
                    <tbody><?php $i = 1; ?>
                        @foreach ($data as $all)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $all->date }}</td>
                            <td>{{ $all->index_no }}</td>
                            <td>{{ $all->full_name }}</td>
                            <td>{{ $all->course_name }}</td>
                            <td>{{ $all->vanue_name }}</td>
                            <td>{{ $all->batch_name }}</td>
                            <td>@if($all->status == 1) 
                                {{ 'Present' }}
                                @elseif($all->status == 2)
                                {{ 'Late' }}
                                @else
                                {{ 'Absent' }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>