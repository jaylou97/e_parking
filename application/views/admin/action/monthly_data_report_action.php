<script type="text/javascript">
    $(document).ready(function() {
        $('#tbl_monthly_statistics').DataTable({
            destroy: true,
            'ajax': '<?php echo base_url() ?>get_monthly_data/' + <?php echo date('Y') ?>,
            "pageLength": 20,
        });
    });

    selectMonthAndYear();

    function selectMonthAndYear() {
        d = new Date();
        m = d.getMonth() + 1;
        y = d.getFullYear();
        $.ajax({
            url: 'get_months_data',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(i, d) {
                    $('#my_month').append($('<option/>', {
                        value: d.date_val,
                        text: d.month_name
                    }));
                });
                $('#my_month').val(m);
            }
        });
        $.ajax({
            url: 'get_years_data',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(i, d) {
                    $('#my_year').append($('<option/>', {
                        value: d.my_yr,
                        text: d.my_yr
                    }));
                });
                $('#my_year').val(y);
            }
        });
    }

    function view_EndOfday_Data(dt, id) {
        window.location.href = 'report_incharge_monthly/' + dt + '/' + id;
    }
    $('#my_year').on('change', function(event) {
        var yy = $('#my_year').val();
        $('#tbl_monthly_statistics').DataTable({
            destroy: true,
            'ajax': '<?php echo base_url() ?>get_monthly_data/' + yy,
            "pageLength": 20,
        });
    });

    function view_monthly_data(month_dt, year_dt) {
        $.post('get_numdata_by_month', {
            month_dt: month_dt,
            year_dt: year_dt
        }, function(num) {
            if (num > 0) {
                window.location.href = 'report_snyc_monthly_data/' + month_dt + '/' + year_dt;
            } else {
                alertToust('info', "There's no data to generate.");
            }
        });
    }
</script>