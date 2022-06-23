<script type="text/javascript">
        function getalldata(){
            $.ajax({
                url:'get_alldata_for_wedget',
                method:'POST',
                dataType:'json',
                success:function(data){
                    $.each(data, function(i, d) {
                        $('#parking_log').html(d.p_log);
                        $('#parking_fee').html(d.p_fee);
                        $('#collection').html(d.penalty);
                        $('#coupon').html(d.total);
                    });
                }
            });   
        }
        
        $('#monthz').on('change', function(){
            update_pie_chart($(this).val());
        });
        function get_location_dataz(){
            var dt_now = $("input[name=date_param]").val();
            $.ajax({
                url:'location_datas_by_dt',
                method:'post',
                data:{
                    dt_now:dt_now
                },
                dataType:'json',
                success:function(data){
                    $('#data_per_loc tbody').find('tr').remove();
                    $.each(data, function(i, d) {
                        $('#data_per_loc').find('tbody').append("<tr><td>"+d.location+"</td><td style='text-align: right; width: 30%;'>"+d.penalty+"</td></tr>");
                    });
                    
                }
            });
        }
        function update_pie_chart(mm){
          $.ajax({
            url:'get_data_for_pie_chart',
            method:'POST',
            data:{
                mm:mm
            },
            dataType:'json',
            success:function(dataz){
                $.ajax({
                    url:'sample_data',
                    method:'POST',
                    dataType:'json',
                    success:function(msg){
                        var pieChart = echarts.init(document.getElementById('pie-chart'));
                        option = {
                            tooltip : {
                                trigger: 'item',
                                formatter: "{a} <br/>{b} : {c} ({d}%)"
                            },
                            legend: {
                                x : 'center',
                                y : 'bottom',
                                data:msg
                            },
                            toolbox: {
                                show : true,
                                feature : {
                                    dataView : {show: true, readOnly: false},
                                    magicType : {
                                        show: true, 
                                        type: ['pie', 'funnel']
                                    },
                                    restore : {show: true},
                                    saveAsImage : {show: true}
                                }
                            },
                            color: ["#f62d51", "#2f3d4a","#ffbc34", "#7460ee","#009efb", "#dddddd","#90a4ae", "#55ce63"],
                            calculable : true,
                            series : [
                            {
                                name:'Location',
                                type:'pie',
                                radius : [30, 110],
                                center : ['50%', 200],
                                roseType : 'area',
                                x: '50%',               
                                max: 500000,                
                                sort : 'ascending',     
                                data:dataz
                            }
                            ]
                        };
                        pieChart.setOption(option, true), $(function() {
                            function resize() {
                                setTimeout(function() {
                                    pieChart.resize()
                                }, 100)
                            }
                            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
                        });
                    }
                });
            }
        });
      }
    function view_monthz(){
       d = new Date();
        m = d.getMonth() + 1;
        y = d.getFullYear();
        $.ajax({
            url:'getThePreviewsData',
            method:'POST',
            data:{
                month:m
            },
            dataType:'json',
            success:function(data){
                $.each(data, function(i, d) {
                 $('#monthz').append($('<option/>',{
                    value:d.month_val,
                    text:d.month
                }));
             });
                $('#monthz').val(m);
                update_pie_chart(m)
            }
        });

    }
    $(document).ready(function($) {  
        getalldata();
        view_monthz();
        get_location_dataz();
    });


    /*jay code*/

    /*disable future date*/
     $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();

    var maxDate = year + '-' + month + '-' + day;    
    $('#cpc_date').attr('max', maxDate);
    });

    /*end jay code*/
</script>