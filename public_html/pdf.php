<?php   
ob_start();
@session_start();
include 'connection.php';
$flujo = 0;
?>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers tr:hover {background-color: #ddd;}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: white;
  color: black;
}
</style>
<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" > <!--EL BACKLEFT SE CAMBIA A 01 O EL VALOR INFERIOR A 10, QUE ES EL POR DEFECTO -->

       <?php 
    
    if (isset($_REQUEST['deliverymaterial']) and isset($_REQUEST['deliverymaterial']) <> ''){
        $datoid = $_REQUEST['deliverymaterial'];
        $flujo=1;
    } else {
        $datoid = $_REQUEST['material'];
        $flujo=2;
    }
    if ($flujo==1){
        
                 $db1 = Db::getConnect(); 
 
    foreach($db1->query("SELECT users.name as nombreesc, dm.created_at, dm.description FROM `delivery_material` dm
    inner join users on
    users.id = dm.id_usercreate
         where id_ingreso = '".$datoid."' limit 1 ") as $filas) {
            $description = $filas['description'];
            $created_at = $filas['created_at'];
            $nombreesc = $filas['nombreesc'];
         }        
    ?>

    <table style='width: 100%; margin-top:-35px '>
        <tr style="text-align:center">
            <td>
                <img src="images/atm.png" style="width:20%; height:20%">
            </td>
        </tr>
        <tr>
  
<td style="text-align: center; width: 100% " >
    <h2 style='color: #131D39'>
					<b>Devolución de materiales N° OEM-<?php echo $datoid ?></b>
				</h2>    
    <h4 style='color: #131D39'>
					<b>Devolución de materiales de escalera a bodega</b>
				</h4>    
 
    
    										

			</td>
			
		</tr>
	</table>
    
    
     <table style='width: 100%;'>
        <tr >
            <td  style='width: 100%;'>Descripción de entrega: <?php echo $description ?>
            </td>
    
        </tr>
        <tr >
            <td  style="width: 50%;text-align:left">Entregado por: <?php echo $nombreesc; ?>
            </td>              
        </tr>
 <tr style="text-align:left">
            <td  style='width: 100%;'>Fecha de entrega: <?php echo $created_at ?>
            </td>   
          	</tr>
     </table>
    
    
    <table  id="customers" style="width:100%;margin-top:10px" >
                                        <thead >
                                        <tr>
                                            <th  style='width: 70%;'>Material</th>
                                            <th  style='width: 20%;'>Unidad de medida</th>
                                            <th  style='width: 10%;'>Cantidad</th>
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
$contador = 0;
foreach($db1->query("SELECT *, mu.name as unidadm, users.name as nombreesc, useacp.name as nombrebodega FROM `delivery_material` dm
    inner join metric_units mu on 
    mu.id = dm.metric_id
    inner join users on
    users.id = dm.id_usercreate
     inner join users useacp on
    useacp.id = dm.id_useraproborneg
         where id_ingreso = '".$datoid."'") as $filas) {
            $product_name = $filas['product_name'];
            $unidadm = $filas['unidadm'];
            $amount = $filas['amount'];
            $description = $filas['description'];
            $receipt = $filas['receipt'];
            $commentreceipt = $filas['commentreceipt'];
            $created_at = $filas['created_at'];
            $nombrebodega = $filas['nombrebodega'];
            $nombreesc= $filas['nombreesc'];
           $contador = $contador  + 1;
           if (($contador%2)==0){
            echo '<tr>
                <td  style="width: 70%;">'.$product_name.'</td>
                    <td style="width: 20%;">'.$unidadm.'</td>
                        <td style="width: 10%;">'.$amount.'</td>
                                        </tr>';   
           } else {
           echo '<tr style="background-color: #f2f2f2;">            
                <td  style="width: 70%;">'.$product_name.'</td>
                    <td style="width: 20%;">'.$unidadm.'</td>
                        <td style="width: 10%;">'.$amount.'</td>
                                        </tr>';
           }
      }
?>                                        
                                            
                                        
                                        </tbody>
                                    </table>
        
        <table style='width: 100%; margin-top:20px '>
                
        <tr>
             <td style="width: 100%;text-align:left">Recibido por: <?php echo $nombrebodega; ?>
            </td>
        </tr>
       
                <tr style="text-align:left">
                    <td  style='width: 100%;'>Fecha de recibido: <?php echo $receipt ?>
            </td>
                </tr>
                <tr style="text-align:left">
                  <td  style='width: 100%;' >Comentario de recibido: <?php echo $commentreceipt ?>
            </td>
                </tr>
	</table>
    
    
    
    
    <table style='width: 100%; margin-top:80px'>
    
        <tr>  
<td style="text-align: center; width:50%" >
    Firma entregado
</td>
<td style="text-align: center; width:50%" >
    Firma recibido
</td>
		</tr>
                    <tr style="text-align:center">
            <td style="text-align: center;" >
    <?php echo  $nombreesc ?>
            </td>
<td style="text-align: center;" >
    <?php echo $nombrebodega ?>
</td>
        </tr>
	</table>
    
     

  <?php 
    }
    //FLUJO = 2
    else {
           $db1 = Db::getConnect(); 
 
    foreach($db1->query("SELECT dm.*, dm.receipt as fecha_recibido, users.name as nombre_requiere, usr_dlv.name as nombre_entrega, usr.name as nombre_crea,usr.name as nombre_crea, pdt.name as product_name, dm.created_at, dm.description FROM `material_report_order` dm
    inner join users on
    users.id = dm.id_userrequire
     inner join users usr on
    usr.id = dm.id_usercreate
     left join users usr_aon on
    usr_aon.id = dm.id_useraproborneg
    left join users usr_dlv on
    usr_dlv.id = dm.id_userdelivery
    inner join devices_inventory pdt on
    pdt.id=dm.material_id 

         where id_matrepord = '".$datoid."' ") as $filas) {
            $description = $filas['description'];
            $created_at = $filas['date_delivery'];
            $nombre_requiere = $filas['nombre_requiere'];
            $nombre_entrega = $filas['nombre_entrega'];
            $product_name = $filas['product_name'];
            $receipt = $filas['fecha_recibido'];
            
         }        
    ?>

    <table style='width: 100%; margin-top:-35px '>
        <tr style="text-align:center">
            <td>
                <img src="images/atm.png" style="width:20%; height:20%">
            </td>
        </tr>
        <tr>
  
<td style="text-align: center; width: 100% " >
    <h2 style='color: #131D39'>
					<b>Entrega de materiales N° OR-<?php echo $datoid ?></b>
             
				</h2>
 <h4 style='color: #131D39'>
					<b>Entrega de materiales de bodega a escalera</b>
             
				</h4>    
 
    
    										

			</td>
			
		</tr>
	</table>
    
    
     <table style='width: 100%;'>
        <tr >
            <td  style='width: 100%;'>Descripción de entrega: <?php echo $description ?>
            </td>
    
        </tr>
        <tr >
            <td  style="width: 50%;text-align:left">Entregado por: <?php echo $nombre_entrega; ?>
            </td>              
        </tr>
 <tr style="text-align:left">
            <td  style='width: 100%;'>Fecha de entrega: <?php echo $created_at ?>
            </td>   
          	</tr>
     </table>
    
    
    <table  id="customers" style="width:100%;margin-top:10px" >
                                        <thead >
                                        <tr>
                                            <th  style='width: 50%;'>Material</th>
                                            <th  style='width: 20%;'>Unidad de medida</th>
                                            <th  style='width: 10%;'>Cantidad solicitada</th>
                                            <th  style='width: 10%;'>Cantidad entregada</th>
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
$contador = 0;
foreach($db1->query("SELECT dm.*, dm.receipt as fecha_recibido,  mu.name as unidadm, users.name as nombre_requiere, usr_dlv.name as nombre_entrega, usr.name as nombre_crea,usr.name as nombre_crea, pdt.name as product_name, dm.created_at, dm.description FROM `material_report_order` dm
    inner join users on
    users.id = dm.id_userrequire
     inner join users usr on
    usr.id = dm.id_usercreate
     left join users usr_aon on
    usr_aon.id = dm.id_useraproborneg
    left join users usr_dlv on
    usr_dlv.id = dm.id_userdelivery
    inner join devices_inventory pdt on
    pdt.id=dm.material_id 
 inner join metric_units mu on 
    mu.id = dm.metric_id
         where id_matrepord = '".$datoid."' ") as $filas) {
            $product_name = $filas['product_name'];
            $unidadm = $filas['unidadm'];
            $amount = $filas['amount'];
            $amount_delivery= $filas['amount_delivery'];
                        $description = $filas['description'];
            $created_at = $filas['date_delivery'];
            $nombre_requiere = $filas['nombre_requiere'];
            $nombre_entrega = $filas['nombre_entrega'];
            $product_name = $filas['product_name'];
            $receipt = $filas['fecha_recibido'];
            
           $contador = $contador  + 1;
           if (($contador%2)==0){
            echo '<tr>
                <td  style="width: 60%;">'.$product_name.'</td>
                    <td style="width: 20%;">'.$unidadm.'</td>
                        <td style="width: 10%;">'.$amount.'</td>
                            <td style="width: 10%;">'.$amount_delivery.'</td>
                            
                                        </tr>';   
           } else {
           echo '<tr style="background-color: #f2f2f2;">            
                <td  style="width: 60%;">'.$product_name.'</td>
                    <td style="width: 20%;">'.$unidadm.'</td>
                        <td style="width: 10%;">'.$amount.'</td>
                            <td style="width: 10%;">'.$amount_delivery.'</td>
                                        </tr>';
           }
      }
?>                                        
                                            
                                        
                                        </tbody>
                                    </table>
        
        <table style='width: 100%; margin-top:20px '>
                
        <tr>
             <td style="width: 100%;text-align:left">Recibido por: <?php echo $nombre_requiere; ?>
            </td>
        </tr>
       
                <tr style="text-align:left">
                    <td  style='width: 100%;'>Fecha de recibido: <?php echo $receipt ?>
            </td>
                </tr>
            
	</table>
    
    
    
    
    <table style='width: 100%; margin-top:80px'>
    
        <tr>  
<td style="text-align: center; width:50%" >
    Firma entregado
</td>
<td style="text-align: center; width:50%" >
    Firma recibido
</td>
		</tr>
                    <tr style="text-align:center">
            <td style="text-align: center;" >
    <?php echo $nombre_entrega  ?>
            </td>
<td style="text-align: center;" >
    <?php echo $nombre_requiere ?>
</td>
        </tr>
	</table>
    
     

  <?php 
    }
  ?>
     <page_footer>
        <table id="footer" align="right" >
            <tr class="fila" >
                <td >
                    <span>                       <?php       
         date_default_timezone_set('America/Lima');  
         echo date("Y-m-d h:i:s");         
         ;?></span>
                </td>
            </tr>
        </table>
    </page_footer>
</page>

<?php
        
    //Incluimos la librería
    //require_once dirname(__FILE__).'/html2pdf/vendor/autoload.php';
require_once dirname(__FILE__).'/vendorpdf/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
   
    //Recogemos el contenido de la vista
  
  
    $html=ob_get_clean();
 
    //Pasamos esa vista a PDF
     
    //Le indicamos el tipo de hoja y la codificación de caracteres
    //P PARA VERTICAL    
//    $mipdf=new HTML2PDF('P','A4','es','true','UTF-8');
 //L PARA HORIZONTAL
    $mipdf=new HTML2PDF('L','A4','es','true','UTF-8');
    
    //Escribimos el contenido en el PDF
    $mipdf->writeHTML($html);
 
    //Generamos el PDF
    
//    
//    $db1 = new PDO('mysql:host=localhost;dbname=mydb','root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
//      foreach($db1->query("SELECT * FROM tb_usuarios tu, tb_subarea ts WHERE ts.id_subarea = tu.area_user
//and id_usuario= '".$_SESSION['id_usuario']."'") as $filas) {
//           
//            $area = $filas['nom_subarea'];        
//        } 
    $mipdf->Output('doc.pdf');
 
?>