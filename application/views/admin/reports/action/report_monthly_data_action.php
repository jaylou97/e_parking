<script>
    $('#btn_back').on('click', function() {
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
        date = months[month] + " " + day + ", " + year;
        TimeDate = date + ' ' + time;
        document.getElementById('myruntime').innerHTML = time;
        document.getElementById('myrundate').innerHTML = date;
    }

    $('#printx').on('click', function() {

        PrintElem('#elem');

        function PrintElem(elem) {
            var dev = $(elem).html();
            var dev1 = $('#elem1').html();
            var dev2 = $('#elem2').html();
            var dev3 = $('#elem3').html();
            var dev4 = $('#elem4').html();
            var dev5 = $('#elem5').html();

            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title + '</title>');
            mywindow.document.write('<head><style>.bordertopbot2{border-top: 1px solid black;border-bottom: 1px solid black;}.bordertopbot3{border-top: 3px solid black;border-bottom: 3px solid black;}.borderbot{border-bottom: 1px solid black;}.ctd{text-align: center; font-size: 13px;}.rtd{text-align:right; font-size: 13px;}');
            mywindow.document.write('.item1{grid-area: main; text-align:top;}.item2{grid-area: right; margin-left:35%; }.grdcon{display:grid; grid-template-areas:"main right";grid-gap: 0px;}');
            mywindow.document.write('</style></head><body style=" font-family: Poppins,sans-serif;">');
            mywindow.document.write('<div class="grdcon"><div class="item1">' + dev + '</div>');
            mywindow.document.write('<div class="item2">' + dev1 + '</div></div>');
            mywindow.document.write('<div >' + dev2 + '</div>');
            mywindow.document.write('<div style="margin-top:5%;font-size:13px;">' + dev3 + '</div>');
            mywindow.document.write('<div style="margin-top:1%;font-size:13px;">' + dev5 + '</div>');
            mywindow.document.write('<div style="margin-top:10%;font-size:13px;" class="grdcon">' + dev4 + '</div>');
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/
            
            mywindow.print();
            mywindow.close();
            //setTimeout(function(){ mywindow.print(); mywindow.close(); },10000);
            //setTimeout(function(){mywindow.print();},2000);
            return true;
        }

    });

</script>