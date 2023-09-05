@extends('index')
@section('content')
    <div class="col-md-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <p class="card-title">SPK</p>
                <form id="save">
                    @if (auth()->guard('admin')->check())
                        <textarea id="myTextarea">
                            {{ $spk->spk }}
                        </textarea>
                    @endif
                    <input type="submit" value="Save">
                </form>
                @if (auth()->guard('mitra')->check())
                    <div id="container">
                        {!! $spk->spk !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if (auth()->guard('mitra')->check())
        <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
            <button id="print-button" class="btn btn-warning btn-icon-text">
                Print
                <i class="ti-printer btn-icon-append"></i>
            </button>
        </div><br>
    @endif
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
        <style>
            @page {
                margin: 5cm;
                size: A4;
            }
        </style>
        <script>
            $("#print-button").click(function() {
                var divToPrint = document.getElementById('container');
                var htmlToPrint = '' +
                    '<style type="text/css">' +
                    'table th, table td {' +
                    'border:1px solid #000;' +
                    'padding:0.5em;' +
                    '}' +
                    '@page {' +
                    'margin: 2cm;' +
                    'size: A4;' +
                    '}' +
                    '</style>';
                htmlToPrint += divToPrint.outerHTML;
                newWin = window.open("");
                newWin.document.write(htmlToPrint);
                newWin.print();
                newWin.close();
            });
        </script>
        <script>
            $(document).ready(function() {

                $("#save").submit(function(e) {

                    var content = tinymce.get("myTextarea").getContent();

                    $("#container").html(content);

                    return false;
                })
            })
        </script>
    @endpush
@endsection
