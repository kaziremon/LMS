<div class="col-md-12 col-x-12 col-sm-12 table-responsive p-3">
                <table  id="dataTableHover" class="table align-items-center table-flush table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Exam Name</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Total Mark</th>
                            <th scope="col">Obtained Mark</th>
                            
                        </tr>
                    </thead>
                    <tbody name="body">
                        @forelse ($data as $key=>$mark)
                        <tr>
                           <th scope="row">{{ $key+1 }}</th>
                            <td> {{ $mark->exam_title }} </td>
                            <td> {{ $mark->title }} </td>
                            <td> {{ $mark->batch_name }} </td>
                            @if(Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                @if($mark->mark_publish == 1)
                                <td> {{ $mark->total_mark }} </td>
                                <td>{{ $mark->obtained_mark }}</td>
                                @else
                                <td> Not published yet </td>
                                <td> Not published yet </td>
                                @endif
                            @elseif(Auth::user()->role_id==3)
                                @if($mark->user_id==Auth::user()->id)
                                    @if($mark->mark_publish == 1)
                                        <td> {{ $mark->total_mark }} </td>
                                        <td>{{ $mark->obtained_mark }}</td>
                                    @else
                                        <td> Not published yet </td>
                                        <td> Not published yet </td>
                                    @endif
                                @else 
                                    <td colspan="2" style="text-align:center">You Can Not Show This Student Mark </td>
                                @endif
                            @else
                                <td colspan="2" style="text-align:center">You Can Not Show This Student Mark </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center">No exam found for this Student</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>