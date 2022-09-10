<form method="post" action="{{ route('comment.add') }}" style="width: 50%;">
    @csrf
    <div class="form-group">
        <input type="text" name="body" class="form-control" />
        <input type="hidden" name="model_class" value="{{ $model::class }}" />
        <input type="hidden" name="model_id" value="{{ $model->id }}" />
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-warning" value="Add Comment" />
    </div>
</form>
