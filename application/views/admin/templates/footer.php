
<!-- JQuery v1.9.1 -->
<script src="<?php echo base_url('public'); ?>/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('public'); ?>/js/bootstrap/bootstrap.min.js"></script>
<!-- Custom JQuery -->
<script src="<?php echo base_url('public'); ?>/js/app/custom.js" type="text/javascript"></script>
<script src="<?php echo base_url('public'); ?>/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url('public'); ?>/js/preview.js"></script>
<script src="<?php echo base_url('public'); ?>/js/hawa.js"></script>
<script src="<?php echo base_url('public'); ?>/js/categori.js"></script>
<script src="<?php echo base_url('public'); ?>/js/popup.js"></script>
<script src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>

<script>
    $(".parent_click a").on("click", function () {
        document.getElementById("display_parent").innerHTML = 'Set as parent';
        document.getElementById("parent").innerHTML = 0;
        $("#display_parent").css('color','green');
    })

    $(".cname .category0 li a" || ".cname .category1 li a").on("click", function () {
        var x = this.text;
        var y = $(this).attr('id');
        document.getElementById("display_cname").innerHTML = x;
        document.getElementById("c_id").innerHTML = y;
        $("#display_cname").css('color','black');
    })

    $(".parent .category0 li a" || ".parent .category1 li a").on("click", function () {
        var x = this.text;
        var y = $(this).attr('id');
        document.getElementById("display_parent").innerHTML = x;
        document.getElementById("parent").innerHTML = y;
        $("#display_parent").css('color','black');
    })

    $(".parent .category3 li a").on("click", function () {
        document.getElementById("display_parent").innerHTML = 'you cannot choose this as parent category';

        $("#display_parent").css('color','red');	})
</script>
<script>
    $("#hide").on("click", function () {
        $(".statics").hide();

    })
    $("#show").on("click", function () {
        $(".statics").show();

    })
</script>
<script>
    function toggle1(source) {
        checkboxes = document.getElementsByName('foo1[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function toggle2(source) {
        checkboxes = document.getElementsByName('foo2[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
<style type="text/css">
    .category3 i {
        display: none;
    }
</style>

</body>
</html>
