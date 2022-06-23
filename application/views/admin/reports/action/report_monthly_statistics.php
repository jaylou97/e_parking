<script type="text/javascript">
	$('#btn_back').on('click', function(){
		window.history.back();
	});



   $('#printx').on('click',function(){
    
    PrintElem('#elem');

         function PrintElem(elem)
        {
            var dev=$(elem).html();
             var dev2=$('#elem2').html();
             var tbl=$('#elem3').html();
             var tbl2=$('#elem4').html();
          
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('<style> .borderall{ border: 1px solid black;height: 35px;}.bordertopbot1{border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;height: 35px;}.bordertopbot2{border-top: 1px solid black;border-bottom: 1px solid black;height: 35px;}.borderbotri{;border-bottom: 1px solid black;border-right: 1px solid black;height: 35px;}.borderbot{border-bottom: 1px solid black;height: 35px;}.bordertop{border-top: 1px solid black;height: 35px;}.ctd{text-align: center;font-size:13px;}.rtd{text-align:right;font-size:13px;}.ltd{text-align:left;}</style>');
            mywindow.document.write('</head><body style="font-family: Poppins,sans-serif;">');
            mywindow.document.write('<div style="text-align: center;">'+dev+'</div>');
            mywindow.document.write('<div style="margin-top:50px;">'+dev2+'</div>');
            mywindow.document.write('<div>'+tbl+'</div><br><br><br>');
            mywindow.document.write('<div style="font-size:14px;">'+tbl2+'</div>');
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }



    });





// var myVar2 = setInterval(myTimerzx, 1000);
//   function myTimerzx() {
//     var d = new Date();
//     day = d.getDate();
//     dd = d.getDay();
//     days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
//     month = d.getMonth();
//     months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
//     year = d.getFullYear();
//     time = d.toLocaleTimeString()
//     date = months[month] + " " + day+", "+year;
//     TimeDate =date +' '+time;
//     document.getElementById('myruntime').innerHTML = time;
//     document.getElementById('myrundate').innerHTML = date ;
  // }    
</script>