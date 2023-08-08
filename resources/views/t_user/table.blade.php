<table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Course Name</th>
        <th scope="col">Batch Name</th>
          <th scope="col">Role Name</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($data as $key=>$item)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td> @isset($item->course_id) {{$item->course->title}} @endisset</td>
            <td> @isset($item->batch_id) {{$item->batch->name}} @endisset</td>
            <td> @isset($item->role_id) {{$item->role->name}} @endisset</td>
          </tr>
        @endforeach
    </tbody>
  </table>




