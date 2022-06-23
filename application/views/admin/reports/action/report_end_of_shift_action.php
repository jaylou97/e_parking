<script>
    $('#btn_back').on('click', function(){
        window.history.back();
    });

    var myVar2 = setInterval(myTimerzx, 1000);
    function myTimerzx() {
        var d = new Date();
        day = d.getDate();
        dd = d.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        month = d.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        year = d.getFullYear();
        time = d.toLocaleTimeString()
        date = months[month] + " " + day+", "+year;
        TimeDate =date +' '+time;
        document.getElementById('myruntime').innerHTML = time;
        document.getElementById('myrundate').innerHTML = date ;
    }
    $('#printx').on('click',function(){
        PrintElem('#elem');

        function PrintElem(elem)
        {
            var dev=$(elem).html();
            var dev1=$('#elem1').html();
            var dev2=$('#elem2').html();
            var dev3=$('#elem3').html();
            var dev4=$('#elem4').html();
            var dev5=$('#elem5').html();
            var dev6=$('#elem6').html();
            var dev7=$('#elem7').html();
            
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('<head><style>.border_r{border-top: 1px solid black;border-bottom: 1px solid black;}.border_v{border-bottom: 1px solid black;}.bordertopbot2{border-top: 2px solid black;border-bottom: 1px solid black;}.bordertopbot3{border-top: 3px solid black;border-bottom: 3px solid black;}.borderbot{border-bottom: 1px solid black;}.ctd{text-align: center; font-size: 13px;}.rtd{text-align:right; font-size: 13px;}.rtdb{text-align:right; font-size: 13px; margin-top: 22%; margin-right: 50px;}');
            mywindow.document.write('<head><style> th{border-top: 1px solid black;border-bottom: 1px solid black;height: 35px;}table tr th{font-weight: bold;}table tfoot tr td{border-top: 1px solid black;border-bottom: 2px solid black;font-weight: bold;} hr{ background-color:black; color:black; }');
            mywindow.document.write('.item1{grid-area: main; text-align:top;}.item2{grid-area: right; margin-left:10%; }.item5{grid-area: right; margin-left:8%; }.grdcon{display:grid; grid-template-areas:"main right";grid-gap: 0px;}#personList {list-style-type: none;margin: 0;padding: 0;width: 100%;}li {display: inline;float: left;margin: 10px; font-size:12px;');
            mywindow.document.write('</style></head><body style=" font-family: Poppins,sans-serif;">');
            mywindow.document.write('<div class="grdcon"><div class="item1">'+dev+'<br><br>'+dev2+'</div>');
            mywindow.document.write('<div class="item2">'+dev1+'<br>'+dev5+'</div></div>');
            mywindow.document.write('<div style="margin-top:5%;">'+dev3+'</div>');
            // mywindow.document.write('<div style="margin-top:5%;">'+dev4+'</div>');
            mywindow.document.write('<div class="row"><div class="col-sm-6 form-inline"><div class="col-md-12 text-right" style="margin-top:-5%;margin-right: 30%;"><table style="margin-top: -12px;">'+dev4+'</table></div></div><div class="col-sm-6 form-inline" style="float: right;"><div class="col-md-12 text-right" style="margin-top: -16%; margin-left: 500px;"><table style="margin-top:-11px;">'+dev7+'</table></div></div></div>');
            mywindow.document.write('<div style="margin-top:13%;" class="grdcon">'+dev6+'</div>');
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }



    });



    /*---------jay code---------------*/
     window.io = {
                open: function(verb, url, data, target){
                    var form = document.createElement("form");
                    form.action = url;
                    form.method = verb;
                    form.target = target || "_self";
                    if (data) {
                        for (var key in data) {
                            var input = document.createElement("textarea");
                            input.name = key;
                            input.value = typeof data[key] === "object"
                                ? JSON.stringify(data[key])
                                : data[key];
                            form.appendChild(input);
                        }

                    }
                    form.style.display = 'none';
                    document.body.appendChild(form);
                    form.submit();
                    document.body.removeChild(form);
                }
            };

    function pdf_print_js()
    {

        // io.open('POST', '<?php echo base_url('hr/generate_summary'); ?>', { cutoff:$(".cutoff").val() },'_blank');
        io.open('POST', '<?php echo base_url('pdf_print_route'); ?>', { incharge_id:$("#incharge_id").val(), dtendz:$("#dtendz").val() },'_blank');
    }

</script>