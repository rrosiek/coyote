<script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey={{ env('TINYMCE_KEY') }}"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 400,
        plugins: [
            'advlist autolink lists link image charmap preview anchor',
            'searchreplace visualblocks code',
            'insertdatetime table contextmenu paste'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        content_css: ['/css/app.css'],
        image_prepend_url: '{{ url("storage/images") }}/',
        @if (isset($images))
            image_list: [
            @foreach ($images as $i)
                @if ($loop->last)
                    { title: '{{ $i }}', value: '{{ $i }}' }
                @else
                    { title: '{{ $i }}', value: '{{ $i }}' },
                @endif
            @endforeach
            ]
        @else
            image_list: []
        @endif
    });
</script>
