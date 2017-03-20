<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 400,
        plugins: [
            'advlist autolink lists link charmap preview anchor',
            'searchreplace visualblocks code',
            'insertdatetime table contextmenu paste'
        ],
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        content_css: ['/css/app.css']
    });
</script>
