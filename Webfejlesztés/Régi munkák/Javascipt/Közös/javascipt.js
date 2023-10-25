function k_elso(){
    alert("Szöveg");
}
for (var i = 0; i<5; i++)
{
    document.WriteLine(i);
}
var a = 5;
var y = 4;
function táblázat (x,y){
    document.write("<table>");
    for(var i = 0; i<x; i++)
    {
        document.write("<td>");
        for(var j = 0 ; j<y;j++){
            document.write("<br>" + (i+1) * (j+1) + "</br>")
        }
        document.write("</td>")
    }
    document.write("</table>")
}