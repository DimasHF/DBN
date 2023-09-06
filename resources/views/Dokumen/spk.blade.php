@extends('index')
@section('content')
    <div class="col-md-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <p class="card-title">SPK</p>
                <form method="POST" action="/admin/spk/save">
                    @csrf
                    <textarea id="myTextarea" name="spk">
                        {{ $spk->spk }}   
                    </textarea>
                    <button type="submit" value="Save">Save</button>
                </form>
            </div>
        </div>
    </div>
    @push('page-script')
        <script>
            tinymce.init({
                selector: '#myTextarea',
                line_height_formats: '0.5 1 1.2 1.4 1.5 2',
                plugins: [
                    'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'prewiew', 'anchor',
                    'pagebreak',
                    'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime',
                    'media',
                    'table', 'emoticons', 'template', 'codesample'
                ],
                toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons',
                menubar: 'favs file edit view insert format tools table',
                content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:12px, line-height: 1.5}',
            });
        </script>
    @endpush
@endsection
