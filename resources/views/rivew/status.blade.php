
<form action="{{route('review.status_update')}}" id="statusUpdat_from" method="POST">
@csrf
<input type="hidden" name="question_id" value="{{$quesion_id->question_id}}">
@foreach ($data as $key=>$item)
<div class="col-md-12 col-x-12 col-sm-12" id="view">
    <div class="card" style="padding: 20px;">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" {{$item->status==1 ? 'checked' : ''}} name="status[]" id="status_{{$item->id}}" value="{{$item->id}}" />
            <label class="form-check-label" for="status_{{$item->id}}">
                {{$item->question}}
            </label>
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
</div>
@endforeach
<input type="button" class="btn btn-success btn-sm m-1 statusupdate" value="Add to Question Bank">
</form>
