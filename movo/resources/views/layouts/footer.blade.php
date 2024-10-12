{{-- footer --}}


@php
    $tags = \App\Models\Tag::all();
@endphp

<div class="container-fluid vh-50 bg-foot mt-5 df dfc jcc">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-5">
                <img src="/asset/login-side.png" alt="" style="width: 100px">
                <h1 class="display-4 mt-3">MOVO</h1>
                <p class="lead">There is always a movie for you. You just need to find on right place</p>
            </div>
            <div class="col-md-7 offset-md-1">
                <div class="row">
                    <div class="col-12">
                        <h1 class="display-6">Available Tags</h1>
                        <p class="lead">Click on the tags to see related movies.</p>
                    </div>
                </div>
                <div class="row">
                    @foreach($tags as $tag)
                    <div class="col-auto mt-3">
                        <a href="/tag/{{$tag->id}}" class="btn btn-outline-secondary">{{$tag->name}}</a>
                    </div>
                    @endforeach
                </div>
               

            </div>
        </div>
    </div>
</div>





<style>
    .bg-foot {
        background-color: rgba(150, 150, 150, 0.1);
    }
</style>
</body>
</html>