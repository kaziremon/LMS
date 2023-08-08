
@foreach ($data as $key=>$item)
    <div class="col-md-12 col-x-12 col-sm-12" id="view">
        <div class="card" style="padding: 20px;">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"  name="setquestion_id[]" id="status_{{$item->id}}" value="{{$item->id}}" />
                        <label class="form-check-label" for="status_{{$item->id}}">
                            {{$item->question}}
                        </label>
                        <p>
                            Difficult Level:{{$item->defficult_level}}

                        </p>

                    </div>
                    @php
                    $allanswer=DB::table('question_answers')->where('setquestion_id',$item->id)->first();
                    $options=DB::table('question_mcqs')->where('setquestion_id',$item->id)->get();
                    $answers=DB::table('question_answers')
                    ->select('question_answers.id','question_answers.answer','question_mcqs.option')
                    ->join('question_mcqs','question_mcqs.id','=','question_answers.answer')
                    ->where('question_answers.setquestion_id',$item->id)
                    ->first();
                @endphp
                    <div class="card-body">
                        @if (isset($answers->option))
                        Answer:{{ $answers->option}}
                        @endif

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mark">Mark</label>
                        <input type="number" class="form-control" id="mark" name="mark_{{$item->id}}"   value="{{$item->mark}}">
                      </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <input type="button" class="btn btn-success btn-sm m-1 insert" value="Add to Question">
