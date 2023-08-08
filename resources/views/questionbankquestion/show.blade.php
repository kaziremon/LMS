
    @foreach ($data as $key=>$item)
    <div class="col-md-12 col-x-12 col-sm-12" id="view">
        <div class="card" id="deleteitem_remove_{{$item->id}}">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <label for="question">{{$key+1}}. Question: {{$item->question}}</label>
                    </div>
                    <div class="col-md-2">
                        <label for="mark">Mark: {{$item->mark}}</label>
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
            @if(!$options->isEmpty())
            <div class="card-body">
              <div class="row">
                @foreach ($options as $key=>$option)
                        <div class="col-md-12">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer_{{$item->id}}" id="answer_{{$item->id}}" value="{{$option->id}}" {{$option->id==$allanswer->answer ? 'checked' : ''}}>
                                <label class="form-check-label">{{$option->option}}</label>
                            </div>
                        </div>
                @endforeach
              </div>
                </div>
                @else
                <p style="margin-left: 20px"><strong>Rubric:</strong>{{$item->rubric}}</p>
                @endif
            </div>
        </div>
</div>
    @endforeach



