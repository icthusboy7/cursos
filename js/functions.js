
$(document).ready(function(){
    loadPrimaryGrid();
    
    cargarGridsecundario();
    
    loadButton();
    if($('.presentations').length == 1){
		presentations();
	}
});



function loadPrimaryGrid(){
    
    //$(document).ready(function(){
        
        $('.campo').click(function(){
            
            $('.gridTR td').removeClass("seleccionaTr");
            $('.gridTR td').removeClass("seleccionaTD");
            $('.gridTR td img').removeClass("seleccionaTD");
            
            tr = $(this).parent();
			
            $(tr).find('td').each(function(){
                    $(this).addClass("seleccionaTr");
            })
            
            $(tr).find('td:first img').each(function(){
                    $(this).addClass("seleccionaTD");
            })
            
        });
        
    //});
}


function cargarGridsecundario(){
    $('.desmarcado').click(function(){
		//alert($('idtable').text());	
                
                load($(this).find("td:nth-child(1)").html());
                
	});
}

function load(str)
{


    
var xmlhttp;

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("inner2").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("POST","../backend/temasFrame.php",true);

xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

xmlhttp.send("q="+str);

}


function loadButton(){
    document.getElementById('button_edit').style.visibility = 'hidden';
    document.getElementById('button_undo').style.visibility = 'hidden';
    document.getElementById('button_add').style.visibility = 'visible';   
    document.getElementById('action_type').value = 'add';
}


function editRow(id, name, status)
{
  document.getElementById('action_type').value = 'edit';
  document.getElementById('id_row').value = id;

  document.getElementById('name').value = name;
  document.getElementById('status').value = status;

  document.getElementById('button_edit').style.visibility = 'visible';
  document.getElementById('button_add').style.visibility = 'hidden';
  document.getElementById('button_undo').style.visibility = 'visible';

}

function buttonUndo()
{
    document.getElementById('button_undo').style.visibility = 'hidden';
    document.getElementById('button_edit').style.visibility = 'hidden';
    document.getElementById('button_add').style.visibility = 'visible';

    document.getElementById('name').value = "";
    document.getElementById('status').value = 1;

    document.getElementById('action_type').value = 'add';
    document.getElementById('id_row').value = "";
}

function saveRow()
{
  
    if(document.getElementById('name').value == '')
    {
        alert('El campo Nombre del curso es requerido');
    }
    else if(document.getElementById('status').value == '')
    {
        alert('El campo estado es requerido');
    }
    else
    {
        if(confirm('¿Desea guardar los cambios?'))
  {
            document.getElementById('form_grid').submit();
        }
    }
}

function deleteRow(id, tabla)
{
    mensaje = '¿Desea eliminar el '+tabla+'?';

    if(confirm(mensaje))
    {
        document.getElementById('id_row').value = id;
        document.getElementById('action_type').value = 'delete';
        document.getElementById('form_grid').submit();
    }
}

function excel(id)
{   

    switch(id)
    {   
        case 1:
            var name = "cursos";
            break;
        case 2:
            var name = "temas";
            break;
        default:
            var name = "listado";
            break;
    }

    var date = new Date();    
    var month = parseInt(date.getMonth()) + 1;
    name = name + date.getFullYear() + month + date.getDate() + date.getHours() + date.getMinutes();
    
    var headers = '';
    $(".thead-columns tr").each(function (index) {
         headers += '<tr>';
         $(this).children("th").each(function (index2) {
                headers += '<th>'+$(this).text()+'</th>';
            });
         headers += '</tr>';
     });

    var rows = '';
    
     $(".tbody-columns tr").each(function (index) {

         if($(this).is(':visible'))
         {

            rows += '<tr>';
            var x1 = 0;
            $(this).children("td").each(function (index2) {
                //if(x1 > 0)
                //{
                //if($(this).text())
                //{
                    rows += '<td>'+$(this).text()+'</td>';
                //}
                //}
                x1 = x1 + 1;
            });
            rows += '</tr>';
         }
     });
    
    var content = '<table><thead>'+headers+'</thead><tbody>'+rows+'</tbody></table>';

    
    window.open('../excel/excel.php?data=' + encodeURIComponent(content)+'&name='+name);

}