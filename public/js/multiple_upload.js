var number_of_uploads;
$("#id_question_pic").change(function() {
    if(number_of_uploads > $(this).attr(max-uploads))
    {
    alert('Your Message');
    }
    else
    {
    number_of_uploads = number_of_uploads + 1;
    }
});