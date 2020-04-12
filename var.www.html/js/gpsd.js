var Tpage=null;
var Trestart=null;
var Tseconds=40;
$( document ).ready(function() 
{
    var oldtbl;
    $("#plw").hide();

    function time(){
        var x = new Date();
        var x1=x.toUTCString();// changing the display to UTC string
        x1 += "<font color='green'> " + x.toTimeString() + " </font>";// changing the display to UTC string
        $('#timedate').html(x1);
    }

    function pagetimer()
    {

        $("#plw").show();
		if($("#timer").length == 0)
		{
    		clearInterval(Tpage);
			Tpage=null;
	        $("#plw").hide(1000);
			return;
		}
        var phpp = $("#pg").html();
        var getv = $("#get_vars").html();
        var postv = $("#post_vars").html();
        $.ajax({
                   url: "./includes/"+phpp+".php?g="+getv+"&p="+postv,
                   success: function(result) {
                       $("#kontent").html(result);
                       html5();
                       networking();
					   drift();

                       $("#plw").hide();
                       if($("#timer").length==null)
                       {
                           if(Tpage)
                               clearInterval(Tpage);
                           Tpage=0;
                       }
                   }
               });
    }

    function html5(){
        if($("#sky").length){
            $("#plw").show();
            $.ajax({
                       url: "./includes/_gpsmco.php",
                       dataType: "json",
                       success: function(result) {
                           canvasit();
                           dejoneize(result);
                           $("#plw").hide();
                       }
                   });
        }//sky
        if($("#timer").length==null ||
           $("#timer").length==0){
            if(Tpage)
                clearInterval(Tpage);
            Tpage=0;
        }
    }

    csrf = $('#csrf_token').val();


    $('.inl').click(function(){
		$("#plw").show();
    });

	if($("#timer").length != 0)
	{
    	Tpage=setInterval(function(){ time(); }, 1000);
    	pagetimer();
	}
	
	if($("#page").html() == "networking")
		networking();


    function networking()
    {
        if($("#pg").html()=="networking")
        {
            getAllInterfaces();
            setupTabs();
            setupBtns() ;
        }
    }


    ////////////////////////////////////////////////////////////////////////////////
    var oldtbl;
    function dejoneize(r)
    {
        var s;
        s="<table border='0' width='100%'>";
        s+="<tr><th >NMEA MODE</th><td>"+r['mode']+"</td></tr>";
        s+="<tr><th >STATUS</th><td>"+r['status']+"</td></tr>";
        s+="<tr><th >TIME</th><td>"+r['time']+"</td></tr>";
        s+="<tr><th >LATITUDE</th><td>"+r['latitude']+"</td></tr>";
        s+="<tr><th >LONGITUDE</th><td>"+r['longitude']+"</td></tr>";
        s+="<tr><th >FROM NORTH</th><td>"+r['track']+" o</td></tr>";
        s+="<tr><th >SPEED</th><td>"+r['speed']+"</td></tr>";
        s+="<tr><th >CLIMB</th><td>"+r['climb']+"</td></tr>";
        s+="<tr><th >LAT +/- </th><td>"+r['epy']+" m</td></tr>";
        s+="<tr><th >LONG +/-</th><td>"+r['epx']+" m</td></tr>";
        s+="<tr><th >ALT +/-</th><td>"+r['epv']+" m</td></tr>";
        s+="<tr><th >DIR +/-</th><td>"+r['epd']+" o</td></tr>";
        s+="<tr><th >SPEED +/-</th><td>"+r['eps']+" m/s</td></tr>";
        s+="<tr><th >CLIMB +/-</th><td>"+r['epc']+" m</td></tr>";
        s+="<tr><th >SAT VISIBLE</th><td>"+r['satelites_visible']+"</td></tr>";
        s+="<tr><th >SAT USED</th><td>"+r['satelites_used'].length+"</td></tr>";
        s+="</table>";
        $("#left").html(s);

        s = "<table width='100%' border='0'><tr><th >SAT#</th><th >AZ</th><th >EL</th><th >PRN</th><tr>";
        var nsats = r['satelites_used'].length;
        var ss = r['satelites_used'];
        if(nsats>0)
        {
            oldtbl="";
            for(var is=0;is<nsats;is++)
            {
                oldtbl+="<tr><td>"+ss[is]["ss"]+"</td><td>"+ss[is]["azimuth"]+"</td><td>"+ss[is]["elevation"]+"</td><td>"+ss[is]["PRN"]+"</td></tr>";
            }
        }
        s+=oldtbl;
        s+="</table>";
        $("#right").html(s);

        if(nsats)
        {
            var canvas = document.getElementById("sky");
            var ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fill();
            draw(ctx);
            posx = canvas.width/2;
            posy = canvas.height/2;
            ctx.strokeStyle = "#FF0000";
            ctx.font = "8px";
            var eee;
            for(var is=0;is<nsats;is++)
            {
                var e = posy-((ss[is]["elevation"] / 90.0) * posy);
                var a = -((ss[is]["azimuth"] / 180.0 ) * Math.PI) - Math.PI/2;
                ctx.beginPath();

                ctx.save();

                    if(ss[is]["ss"]>90)
                        ctx.strokeStyle = "#F00";
                    if(ss[is]["ss"]>60)
                        ctx.strokeStyle = "#D40";
                    if(ss[is]["ss"]>30)
                        ctx.strokeStyle = "#720";
                    else
                        ctx.strokeStyle = "#410";

                    ctx.lineWidth=1;
                    ctx.translate(posx, posy);
                    ctx.rotate(a);

                    ctx.translate(e, 0);
//                    ctx.strokeRect(0,0,4,4);
//                    ctx.strokeRect(0,0,ss[is]["ss"]/4,ss[is]["ss"]/4);
                    ctx.arc(0 ,0 , ss[is]["ss"]/7, 0, 2 * Math.PI);
					ctx.stroke();
                    ctx.translate(-8,-11);
                    ctx.rotate(-a);
                    //ctx.strokeText(ss[is]["ss"]+"%", 0,0);


                ctx.restore();
            }
            ctx.lineWidth = 1;
        }
    }

    function canvasit()
    {
        var canvas = document.getElementById("sky");
        var ctx = canvas.getContext("2d");
        posx = canvas.width/2;
        posy = canvas.height/2;
        draw(ctx);
    }

    function draw(ctx)
    {
        ctx.fillStyle = "#DDCCCC";
        ctx.beginPath();
        ctx.arc(posx, posy, posy, 0, 2 * Math.PI);
        ctx.fill();

        ctx.strokeStyle = "#7777FF";

        ctx.beginPath();
        ctx.arc(posx, posy, posy/2, 0, 2 * Math.PI);
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(posx, posy, posy/4, 0, 2 * Math.PI);
        ctx.stroke();

        ctx.beginPath();
        ctx.arc(posx, posy, 3*posy/4, 0, 2 * Math.PI);
        ctx.stroke();

        ctx.strokeStyle = "#0000FF";
        ctx.beginPath();
        ctx.arc(posx, posy, posy-1, 0, 2 * Math.PI);
        ctx.stroke();


        ctx.beginPath();
        ctx.moveTo(posx, posy);
        ctx.lineTo(posx-posy,posy);
        ctx.moveTo(posx, posy);
        ctx.lineTo(posx+posy,posy);
        ctx.moveTo(posx, posy);
        ctx.lineTo(posx,0);
        ctx.lineTo(posx,posy*2);
        ctx.stroke();
    }



});

function msgShow(retcode,msg) {
    if(retcode == 0) {
        var alertType = 'success';
    } else if(retcode == 2 || retcode == 1) {
        var alertType = 'danger';
    }
    var htmlMsg = '<div class="alert alert-'+alertType+' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+msg+'</div>';
    return htmlMsg;
}

function createNetmaskAddr(bitCount) {
    var mask=[];
    for(i=0;i<4;i++) {
        var n = Math.min(bitCount, 8);
        mask.push(256 - Math.pow(2, 8-n));
        bitCount -= n;
    }
    return mask.join('.');
}

function loadSummary(strInterface) {
    $.post('/ajax/networking/get_ip_summary.php',{interface:strInterface},function(data)
    {
        jsonData = JSON.parse(data);
        //        console.log(jsonData);
        if(jsonData['return'] == 0) {
            $('#'+strInterface+'-summary').html(jsonData['output'].join('<br />'));
        } else if(jsonData['return'] == 2) {
            $('#'+strInterface+'-summary').append('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+jsonData['output'].join('<br />')+'</div>');
        }
    });
}

function getAllInterfaces() {
    $.get('/ajax/networking/get_all_interfaces.php',function(data){
        jsonData = JSON.parse(data);
        $.each(jsonData,function(ind,value){
            loadSummary(value)
        });
    });
}

function setupTabs() {

    $('.aclick').click(function(){
        var target = $(this).attr('href');
        if(!target.match('summary'))
        {
            var int = target.replace("#","");
            loadCurrentSettings(int);
        }
    });
}

function loadCurrentSettings(strInterface) {
    $.post('/ajax/networking/get_int_config.php',{interface:strInterface},function(data){
        jsonData = JSON.parse(data);
        $.each(jsonData['output'],function(i,v) {
            var int = v['interface'];
            $.each(v,function(i2,v2) {
                switch(i2) {
                case "static":
                    if(v2 == 'true') {
                        $('#'+int+'-static').click();
                        $('#'+int+'-nofailover').click();
                    } else {
                        $('#'+int+'-dhcp').click();
                    }
                    break;
                case "failover":
                    if(v2 === 'true') {
                        $('#'+int+'-failover').click();
                    } else {
                        $('#'+int+'-nofailover').click();
                    }
                    break;
                case "ip_address":
                    if(v2=="/")v2="";
                    $('#'+int+'-ipaddress').val(v2);
                    break;
                case "net_mask":
                    $('#'+int+'-netmask').val(v2);
                    break;
                case "routers":
                    $('#'+int+'-gateway').val(v2);
                    break;
                case "ssid":
                    $('#'+int+'-ssid').val(v2);
                    break;
                case "psk":
                    $('#'+int+'-psk').val(v2);
                    break;
                case "domain_name_server":
                    $('#'+int+'-dnssvr').val(v2);
                    break;
                }
            });
        });
    });
}

function saveNetworkSettings(int) {

    var frmInt = $('#frm-'+int).find(':input');
    var arrFormData = {};
    $.each(frmInt,function(i3,v3){
        if($(v3).attr('type') == 'radio') {
            arrFormData[$(v3).attr('id')] = $(v3).prop('checked');
        } else {
            arrFormData[$(v3).attr('id')] = $(v3).val();
        }
    });
    arrFormData['interface'] = int;
    arrFormData['csrf_token'] = csrf;
    $.post('/ajax/networking/save_int_config.php',arrFormData,function(data){
        console.log(data);
        var jsonData = JSON.parse(data);
        $('#msgNetworking').html(msgShow(jsonData['return'],jsonData['output']));
    });
}

function restarting()
{
	if(Tseconds-->0)
		$('#msgNetworking').html(msgShow(jsonData['return'], "Restarting network and avahi: " + Tseconds + " s"));
	else{
		clearInterval(Trestart);
		Trestart = null;
	    window.location.href = "index.php?page=networking";
	}
}


function applyNetworkSettings() {
    var int = $(this).data('int');
    arrFormData = {};
    arrFormData['csrf_token'] = csrf;
    arrFormData['generate'] = '';
    $.post('/ajax/networking/gen_int_config.php',arrFormData,function(data){
        //alert(data);
        var jsonData = JSON.parse(data);
        $('#msgNetworking').html(msgShow(jsonData['return'],jsonData['output']));
		if(jsonData['return']==0)
		{
		    $("#plw").show();
	        if(Trestart==null){
				Tseconds=70;	
				Trestart=setInterval(function(){ restarting(); }, 1000);
			}

            $('#msgNetworking').html(msgShow(jsonData['return'],"Restarting network. Refresh page manually after 30 seconds or so"));
			$.post("ajax/networking/restart_network.php", function( data ) 
			{
			    $("#plw").hide();
			});
		}
    });
}

function setupBtns() {
    $('#btnSummaryRefresh').click(function(){getAllInterfaces();});

    $('.intsave').click(function(){
        var int = $(this).data('int');
        saveNetworkSettings(int);
        applyNetworkSettings();
    });


    $('.dhcpoff').click(function(){
        $(".dhhide").show(100);
    });

    $('.dhcpon').click(function(){
        $(".dhhide").hide(100);
    });

}


function drift()
{
 if( $('#chart').length )
 {
 var _labels=[];
 var _arrdata = $('#arrdata').html().split("\n");
 for(var i=0; i<_arrdata.length;i++)
 {
	_arrdata[i]=parseFloat(_arrdata[i]);
    _labels[i]=i;
 }
// alert(_arrdata.length);
 var ctx = document.getElementById("chart").getContext('2d');

 var myChart = new Chart(ctx, {
     type: 'line',
     data: {
		 labels:_labels,
         datasets: [{
             label: 'per miliion',
             data: _arrdata,
             backgroundColor: [
                 'rgba(155, 000, 000, 1.0)'
             ],
             borderWidth: 0,
             borderColor: "#FFF",
             fill: false,
         }]
     },

     options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: { /*remove toicker*/
                display: false
            },
            scales: {
             yAxes: [{
                 ticks: {
                     beginAtZero:false
                 },
                 gridLines: {
                   display: true ,
                   color: "#445522"
                 },
             }],
             xAxes: [{
                 gridLines: {
                   display: true ,
                   color: "#445522"
                 },
             }],
             layout: {
                 padding: {
                     left: 10,
                     right: 10,
                     top: 0,
                     bottom: 0
                 }
             }
         }
     }
  });
 }//myChart.length
}
