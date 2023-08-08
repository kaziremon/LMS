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
                <div class="col-md-12">
                    <div class="col-md-6">
                        @isset($info)
                        <h5>Trainee Name: {{ $info->full_name }}</h5>
                        <h5>Course Name : </b> {{ $info->title }}</h5>
                        <h5>Venue Name : </b> {{ $info->venue_name }}</h5>
                        <h5>Batch Name : </b> {{ $info->batch_name }}</h5>
                        @endisset
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <table id="table" class="table table-bordered">
                    <div id="example1_wrapper"></div>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                    <thead>
                        <tr>
                            <th scope="col">Exam Name</th>
                            <th scope="col">Total Marks</th>
                            <th scope="col">Obtained Marks</th>
                            <th scope="col">Grade</th>
                        </tr>
                    </thead>
                    <tbody name="body">
                        @forelse ($marksheets as $key=>$mark)
                        <tr>
                            <td> {{ $mark->exam_title }} </td>
                            <td> {{ $mark->total_mark }} </td>
                            @if($mark->mark_publish == 1)
                            <td> {{ $mark->obtained_mark }} </td>
                            @if(($mark->obtained_mark/$mark->total_mark)*100 >= 80)
                            <td> A+</td>
                            @elseif(($mark->obtained_mark/$mark->total_mark)*100 >= 70)
                            <td> A </td>
                            @elseif(($mark->obtained_mark/$mark->total_mark)*100 >= 60)
                            <td> B </td>
                            @elseif(($mark->obtained_mark/$mark->total_mark)*100 >= 50)
                            <td> C </td>
                            @elseif(($mark->obtained_mark/$mark->total_mark)*100 >= 40)
                            <td> D </td>
                            @else
                            <td> F </td>
                            @endif
                            @else
                            <td> Not published yet </td>
                            <td> Not published yet </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center">No exam found for this trainee</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>