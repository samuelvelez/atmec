<?php 
include 'configfile.php';                 
 $sql = 'SELECT * FROM storage where status=1;';
         $resultado = mysqli_query($db_link, $sql);
 
?>
  <div class="container text-center">
      <center><p style="font-size:300%; font-weight: bold">Importar Productos a Bodega</p></center>
<div class="container">

    
    
    <center> <table cellspacing="20" cellpadding="20" border="3">
    <tr>    <th>


    
    <?php
include('dbconect.php');
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');
    date_default_timezone_set('America/Lima');


if (isset($_POST["import"]))
{
    $fechacreacion = date('Y-m-d H:i');       
    $storageid = $_REQUEST['storage_id'];
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'subidas/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $namep = "";      
                if(isset($Row[0])) {
                    $namep = mysqli_real_escape_string($con,$Row[0]);
                }
                
                $quantityp = "";
                if(isset($Row[1])) {
                    $quantityp = mysqli_real_escape_string($con,$Row[1]);
                }
                 $unitp = "";
                if(isset($Row[2])) {
                    $unitp = mysqli_real_escape_string($con,$Row[2]);
                }		
               
                if (!empty($namep) || !empty($quantityp) ) {

include 'configfile.php';
                  
 $sql = 'SELECT * FROM devices_inventory WHERE name LIKE "%'.$namep.'%" LIMIT 1 ;';
         $result = mysqli_query($db_link, $sql);

         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               $deviceid = $row["id"];
            }
         } else {
            $deviceid = 'REVISAR PRODUCTO';
         }
                  
         
         mysqli_close($db_link);                     
                    
                    
$query = "INSERT INTO `storage_inventory`( `storage_id`, `device_id`, `quantity`, `created_at`, `updated_at`)
     VALUES ('".$storageid."','".$deviceid."','".$quantityp."','".$fechacreacion."','".$fechacreacion."')";
                    $resultados = mysqli_query($con, $query);                
                    if (! empty($resultados)) {
//                        $type = "success";
//                        $message = "Excel importado correctamente";
                    } else {
                        $type = "error";
                        $message = "Hubo un problema al importar registros";
                    }
                }
             }
   
         }

         
echo "<script>location.href='storage-inventory/'</script>";      
          }
          
          
 else
  {  
        $type = "error";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
}    
    
    
?>
           

   <body>
<div class="container">
        <hr>

  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
    
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Escoja la bodega a la que va a importar el archivo</label>
                <select name="storage_id" required="">
                 <?php 
                 if (mysqli_num_rows($resultado) > 0) {
            while($row = mysqli_fetch_assoc($resultado)) {
               $deviceid = $row["id"];
               $devicename = $row["name"];
               echo '<option value="'.$row["id"].'">'.$devicename.'</option>';
            }
         }
                 ?>
                    
                </select>
                <br><br>
                <label>Elija Archivo Excel</label> <input type="file" name="file" required=""
                    id="file" accept=".xls,.xlsx">
                <br><BR><button type="submit" id="submit"  class="mb-xs mt-xs mr-xs btn btn-success"  name="import"
                       >Importar Registros</button>
            <hr>

            </div>
                </form>
               
    </div>
 
</body>
 </tr>    </th>

        
 </table></center>
    </html> 
    </div></div>
<?php 

?>