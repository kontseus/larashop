<div class="col-12 d-flex flex-column justify-content-center align-items-center">
    <div class="card" style="width: 80%;">
        <div class="card-header">
            <strong>{{ $comment->user->full_name }}</strong>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $comment->body }}</p>
        </div>
        <div class="card-footer">
            <form method="post" class="d-none" action="{{ route('comment.reply') }}" style="width: 100%;">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                    <input type="hidden" name="model_class" value="{{ $model::class }}" />
                    <input type="hidden" name="model_id" value="{{ $model->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning" value="Add Reply" />
                </div>
            </form>
            <a href="#" class="reply">Reply</a>
        </div>
    </div>
    <br>
    <div class="row d-flex flex-column align-self-end" style="width: 95%;">
        @if(!empty($comment->replies))
            @foreach($comment->replies as $reply)
                @include('comments/_single_comment', ['comment' => $reply, 'model' => $model])
            @endforeach
        @endif
    </div>
</div>
