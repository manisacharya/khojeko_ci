$("#third input[type=checkbox]").on("click", function() { 
    if ($(this).attr("noneoption") == "false") {
        $("#third input[type=checkbox][noneoption=true]").attr("checked", false);
    }
    else if ($(this).attr("noneoption") == "true") {
        $("#third input[type=checkbox][noneoption=false]").attr("checked", false);
    }
});