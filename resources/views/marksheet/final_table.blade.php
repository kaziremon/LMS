<script>
    // $(document).ready(function() {
    //     $('#table').DataTable({
    //         "paging": false,
    //         "bInfo": false,
    //         "bSort": false,
    //         dom: 'Bfrtip',
    //         "createdRow": function(row, data, index) {
    //             $('td', row).eq(1).addClass('wrap');
    //         },
    //         buttons: [
    //             'copy',
    //             {
    //                 extend: 'excel',
    //                 messageTop: 'Marksheet',
    //                 filename: 'Marksheet'
    //             },
    //             {
    //                 extend: 'csv',
    //                 messageTop: 'Marksheet',
    //                 filename: 'Marksheet'
    //             },
    //             {
    //                 extend: 'pdf',
    //                 messageTop: 'Marksheet',
    //                 filename: 'Marksheet',
    //                 title: 'Marksheet',
    //                 orientation: 'landscape',
    //                 pageSize: 'LEGAL'
    //             },
    //             {
    //                 extend: 'print',
    //                 title: function() {
    //                     return "<div style='font-size: 15px;text-align:center;'>Marksheet</div>";
    //                 }
    //             }
    //         ]
    //     });
    // });
    function printFunc() {
        var divToPrint = document.getElementById('div_print');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            'table th, table td {' +
            'border:1px solid #000;' +
            'width:100%;' +
            'text-align:center;' +
            //'padding;0.2em;' +
            '}' +
            '</style>';
        htmlToPrint += divToPrint.outerHTML;
        newWin = window.open("");
        newWin.document.write("<h3 align='center'>Marksheet</h3>");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
    }
</script>
<div class="content-header">
    <input type='button' id='btn' style="float: right;" value='Print' onclick='printFunc();'>
    <hr>
    <div class="container-fluid">
    <br>
    <div class="row">
        <div id="div_print" class="table-responsive">
            <table id="table" class="table table-bordered">
                <div id="example1_wrapper"></div>
                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="2">Trainee Name</th>
                        <th class="text-center" colspan="{{sizeof($exams)}}">exam</th>
                        <th class="text-center" colspan="{{sizeof($group_assignments)}}">Group assignments</th>
                        <th class="text-center" colspan="{{sizeof($ind_assignments)}}">Individual assignments</th>
                        <th class="text-center" rowspan="2">Total Marks</th>
                        <th class="text-center" rowspan="2">Grade</th>
                    </tr>
                    <tr>
                        @foreach($exams as $key=>$exam)
                        <th class="text-center" scope="col">{{$exam->exam_title}}</th>
                        @endforeach
                        @foreach($group_assignments as $key=>$assignment)
                        <th class="text-center" scope="col">{{$assignment->topics}}</th>
                        @endforeach
                        @foreach($group_assignments as $key=>$assignment)
                        <th class="text-center" scope="col">{{$assignment->topics}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody name="body">
                        @foreach($marks as $key=>$mark)
                        <tr>
                            <td>{{$mark->full_name}}</td>
                            <td>{{$mark->obtained_mark}}</td>
                            <td>{{$mark->ga_mark}}</td>
                            <td>{{$mark->ia_mark}}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <!-- /.container-fluid -->

</div>