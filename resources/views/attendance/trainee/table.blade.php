
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
                            <th scope="col">Sl.</th>
                            <th scope="col">Date</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody name="body">
                        @foreach ($data as $key=>$all)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td> {{ $all->date }} </td>
                            <td> {{ $all->batch_name }} </td>
                            <td> @if($all->status == 1) 
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