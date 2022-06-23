<script type="text/javascript">
    $(document).ready(function() {
        selectMonthAndYear();
    });

                    /*jay code*/
     
     /*document.getElementById("generate_report_jay").disabled = true;*/

     $('#month_from, #my_year1, #month_to, #my_year2').on('change', function() 
     {
        $year_jay = new Date().getFullYear();  
        $month_jay = new Date().getMonth()+1;
        /*$month_to_jay = parseInt($('#month_to').val());
        console.log($month_jay);*/

        if(parseInt($('#my_year1').val()) > parseInt($('#my_year2').val())) 
        {
             Swal.fire('Invalid Date', 'From: is never greather than To:!', 'error')
            /* location.reload();
            selectMonthAndYear();*/
            document.getElementById("generate_report_jay").disabled = true;
        }
        else if(parseInt($('#my_year1').val()) == parseInt($('#my_year2').val()) && parseInt($('#month_from').val()) > parseInt($('#month_to').val()))
        {
             Swal.fire('Invalid Date', 'From: is never greather than To:!', 'error')
              /* location.reload();
            selectMonthAndYear();*/
            document.getElementById("generate_report_jay").disabled = true;
        }
         else if(parseInt($('#my_year2').val()) == $year_jay && parseInt($('#month_to').val()) > $month_jay)
        {
              Swal.fire('Invalid Date', 'Do not select future date!', 'error')
            /*  location.reload();
            selectMonthAndYear();*/
            document.getElementById("generate_report_jay").disabled = true;
        }
        else
        {
            document.getElementById("generate_report_jay").disabled = false;
        }
    });
                    /*end of jay code*/


   /* $('#month_from, #month_to').on('change', function() {
        if (parseInt($('#month_from').val()) > parseInt($('#month_to').val())) {
            alertToust('info', 'Invalid inputed date, please check & try again.');
            selectMonthAndYear()
        }
    });*/

    function submitDateInput() {
        // window.location.href = `report_MonthlyRangeData/${$('#month_from').val() + "-" + $('#month_to').val() + "-" + $('#my_year').val()}`;
        window.location.href = "report_MonthlyRangeData/"+$('#month_from').val() + "-" + $('#my_year1').val() + "/" + $('#month_to').val() + "-" + $('#my_year2').val()+"";
    }

    function selectMonthAndYear() {
        d = new Date();
        m = d.getMonth() + 1;
        y = d.getFullYear();
        $('#month_from').html('');
        $('#month_to').html('');
        $.ajax({
            url: 'get_months_data',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(i, d) {
                    $('#month_from, #month_to').append($('<option/>', {
                        value: d.date_val,
                        text: d.month_name
                    }));
                });
                $('#month_from, #month_to').val(m);
            }
        });
        $.ajax({
            url: 'get_years_data',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                // $.each(data, function(i, d) {
                //     $('#my_year').append($('<option/>', {
                //         value: d.my_yr,
                //         text: d.my_yr
                //     }));
                // });
                // $('#my_year').val(y);

                $.each(data, function(i, d) {
                    $('#my_year1, #my_year2').append($('<option/>', {
                        value: d.my_yr,
                        text: d.my_yr
                    }));
                });
                $('#my_year1, #my_year2').val(y);
            }
        });
    }
</script>