
/*
    var canvas = document.getElementById("sky");
    if(canvas != null){
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
*/



/*
function dejoneize(r)
{
//    $('#txt').html(JSON.stringify(r));
    var s;
    s="<table border='1' width='100%'>";
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

    s = "<table width='100%' border='1'><tr><th >SAT#</th><th >AZ</th><th >EL</th><th >PRN</th><tr>";
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
	if(canvas==null)return;
        var ctx = canvas.getContext("2d");
 //       ctx.save();

// Use the identity matrix while clearing the canvas
//        ctx.setTransform(1, 0, 0, 1, 0, 0);
       ctx.clearRect(0, 0, canvas.width, canvas.height);

// Restore the transform
   //     ctx.restore();

  //      ctx.arc(posx, posy, posy, 0, 2 * Math.PI);
        ctx.fill();
		draw(ctx);

        posx = canvas.width/2;
        posy = canvas.height/2;
        ctx.strokeStyle = "#FF0000";
        for(var is=0;is<nsats;is++)
        {
//            ss[is]["elevation"]=90;
            var e = posy-((ss[is]["elevation"] / 90.0) * posy);
            var a = ((ss[is]["azimuth"] / 180.0 ) * Math.PI) - Math.PI/2;
            var arc = .001 * (20+ss[is]["elevation"]);
            ctx.beginPath();
            ctx.arc(posx, posy, e, a-arc,a+arc);
            ctx.lineWidth=7;
            ctx.stroke();
        }
        ctx.lineWidth = 1;
    }
}
*/

