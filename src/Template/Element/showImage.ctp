<script type="text/javascript">
$(document).ready(function() {
    $('.js-show-image').click(function() {
        $.ajax({
            url: "<?php echo $this->Url->build(['controller' => 'students', 'action' => 'getimage', $student->id]); ?>",
            success: function (data) {
                if (data != "not_found") {
                    var path = JSON.parse(data).path;

                    var img = document.createElement('img');
                    img.setAttribute('src', path);

                    $('.img-placeholder').append(img);
                }
            }
        });
    });
});
</script>
