
    @foreach ($data as $key=>$item)
    <div class="col-md-12 col-x-12 col-sm-12" id="view">
    <form action="{{route('question_review.update',$item->id)}}" method="POST" id="fromdata_{{$item->id}}">
        @csrf
        @method('PUT')
        <div class="card" id="deleteitem_remove_{{$item->id}}">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <label for="question">Question</label>
                        <textarea id="queston" class="form-control" name="question"  cols="30" rows="2" required>{{$item->question}}</textarea>
                    </div>
                    <div class="col-md-2">
                        <label for="mark">Mark</label>
                        <input type="number" value="{{$item->mark}}" id="mark" name="mark" class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="difficult_level">Question Difficult Level</label>
                            <select name="defficult_level" class="js-example-basic-single form-control @error('defficult_level') is-invalid @enderror" required>
                                <option>Select Difficult Leval</option>
                                <option value="Easy" {{$item->defficult_level =='Easy' ? 'selected' : ''}}>Easy</option>
                                <option value="Medium" {{$item->defficult_level =='Medium' ? 'selected' : ''}}>Medium</option>
                                <option value="Hard" {{$item->defficult_level =='Hard' ? 'selected' : ''}}>Hard</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @php
             $allanswer=DB::table('question_answers')->where('setquestion_id',$item->id)->first();
             $options=DB::table('question_mcqs')->where('setquestion_id',$item->id)->get();
             $answers=DB::table('question_answers')
             ->select('question_answers.id','question_mcqs.option')
             ->join('question_mcqs','question_mcqs.id','=','question_answers.answer')
             ->where('question_answers.setquestion_id',$item->id)
             ->first();
            @endphp
            <div class="card-body">
              @if(!$options->isEmpty())
              <div class="row">
                @foreach ($options as $key=>$option)
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" id="" value="{{$option->id}}" {{$option->id==$allanswer->answer ? 'checked' : ''}}>
                                <label class="form-check-label" for="">
                                    <input type="hidden" name="option[]" value="{{$option->id}}">
                                    <input type="text" name="{{$option->id}}" value="{{$option->option}}" class="form-control">
                                </label>
                            </div>
                        </div>
                @endforeach
              </div>
                <div class="d-inline p-2 text-right text-dark" style="float: right">
                    @can('review.status')
                        <button onClick="savetoquestionbank({{$item->id}})" type="button" class="btn btn-info btn-sm m-1"><i class="fas fa-thumbs-up"></i> Save To Question Bank</button>
                    @endcan
                    {{-- <a href="{{ route('question_review.status_update',$item->id) }}"  class="status_update btn btn-info btn-sm m-1" data-id="{{$item->id}}"><i class="fas fa-thumbs-up"></i> Save To Question Bank</a> --}}
                    @can('review.edit')
                    <button onClick="insert({{$item->id}})"   type="button" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Update</button>
                    @endcan
                    @can('review.destroy')
                    <button onClick="deleteConfirmation({{$item->id}})" type="button" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt"></i> Delete</button>
                    @endcan
                    {{-- <a href="{{ route('question_review.destroy',$item->id) }}"  class="button btn btn-danger btn-sm m-1" data-id="{{$item->id}}"><i class="fas fa-trash-alt"></i> Delete</a> --}}
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Rubric</label>
                            <textarea name="rubric" style="width: 100%" id="" cols="30" rows="3">{{$item->rubric}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-inline p-2 text-right text-dark" style="float: right">
                    @can('review.status')
                    <button onClick="savetoquestionbank({{$item->id}})" type="button" class="btn btn-info btn-sm m-1"><i class="fas fa-thumbs-up"></i> Save To Question Bank</button>
                    @endcan
                    {{-- <a href="{{ route('question_review.status_update',$item->id) }}"  class="status_update btn btn-info btn-sm m-1" data-id="{{$item->id}}"><i class="fas fa-thumbs-up"></i> Save To Question Bank</a> --}}
                    @can('review.edit')
                    <button onClick="insert({{$item->id}})"   type="button" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Update</button>
                   @endcan
                   @can('review.destroy')
                   <button onClick="deleteConfirmation({{$item->id}})" type="button" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt"></i> Delete</button>
                    @endcan
                   {{-- <a href="{{ route('question_review.destroy',$item->id) }}"  class="button btn btn-danger btn-sm m-1" data-id="{{$item->id}}"><i class="fas fa-trash-alt"></i> Delete</a></div> --}}
                @endif
            </div>
        </div>

    </form>
</div>
    @endforeach



