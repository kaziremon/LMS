<div>
    @isset($data->batch->name)
        Batch:{{$data->batch->name}}
    @endisset
    @isset($data->role->name)
        Role:{{$data->role->name}}
    @endisset
</div>
