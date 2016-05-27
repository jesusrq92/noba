<?php 
header("Content-Type: text/html;charset=utf-8");
    // $db = mysqli_connect('localhost', '071bd473eb6a', '0d8c26cb5cc576af', 'nobadb'); //---- datos produccion agregar si hacen falta ----

    $db = mysqli_connect('localhost', 'root', 'root', 'NOBA_DB2');
    $acentos = $db->query("SET NAMES 'utf8'"); //datos local
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to MySQL: '.mysqli_connect_error();
    }



    function  checkmailf1($cor){
        if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$cor))
        {
            return true;
        }
        else{
            return false;
        }
    }

    if(isset($_POST['nombre']) && !empty($_POST['nombre']) 
      AND isset($_POST['tel']) && !empty($_POST['tel'])
      AND isset($_POST['corr']) && !empty($_POST['corr']) 
      AND isset($_POST['giro']) && !empty($_POST['giro']) 
      AND isset($_POST['estado']) && !empty($_POST['estado']) 
      AND isset($_POST['msj']) && !empty($_POST['msj']))
    {	

        $nomm = mysqli_real_escape_string($db,$_POST['nombre']);
        $tl = mysqli_real_escape_string($db,$_POST['tel']);
        $cor = mysqli_real_escape_string($db,$_POST['corr']);
        $se1 = mysqli_real_escape_string($db,$_POST['giro']);
        $se2 = mysqli_real_escape_string($db,$_POST['estado']);
        $mj = mysqli_real_escape_string($db,$_POST['msj']);
        $longnom = strlen ($nomm);
        $longnum = strlen ($tl);

        if($longnum  >= 10 ){
            if(checkmailf1($cor)){

                if(!is_numeric($nomm))
                {
                   if($longnom > 1)
                   {

                    $sql="INSERT INTO ContactoFormm(`id`, `nombre`,`telefono`,`correo`,`giro_empresa`,`estado_republica`,`msj`) VALUES
                    ('','$nomm','$tl','$cor','$se1','$se2','$mj')";
                    $saveDB = mysqli_query($db,$sql);
                    if($saveDB){


                     echo "<div id='Ajx'><script>document.getElementById('nobaF').reset(); </script> 
                     <script>swal({   title: 'Datos guardados.',   text: 'Gracias por ponerte en contacto.',   type: 'success',   showCancelButton: false,   confirmButtonColor: '#43B763',   confirmButtonText: 'OK',   closeOnConfirm: true}); </script></div>"; 

                 }

                 else{

                  echo "<div id='Ajx'>
                  <script>sweetAlert({title:'Error',text:'Ocurrio un error en la base de datos',confirmButtonColor:'#F06060' ,type:'error'}); </script></div>"; 
                  echo   mysqli_error($db);
              }

          }else
          {
            echo "<div id='Ajx'>
            <script>sweetAlert({title:'Error',text:'Tu nombre debe contener 2 letras como minimo',confirmButtonColor:'#F06060' ,type:'error'}); </script></div>"; 
        }

    }
    else {
       echo "<div id='Ajx'>
       <script>sweetAlert({title:'Error',text:'El campo nombre debe ser texto ',confirmButtonColor:'#F06060' ,type:'error'}); </script></div>"; 
   }
}

else{
    echo "<div id='Ajx'> 
    <script>sweetAlert({title:'Error',text:'Este e-mail es incorrecto',confirmButtonColor:'#F06060',type:'error'}); </script></div>";

}
}

else{

   echo "<div id='Ajx'> 
   <script>sweetAlert({title:'Error',text:'El campo telefono debe contener 10 digitos como minimo',confirmButtonColor:'#F06060',type:'error'}); </script></div>";
}
}
else{
	echo "<div id='Ajx'>
	<script>sweetAlert({title:'Error',text:'Datos incompletos',confirmButtonColor:'#F06060',type:'error'});</script></div>";
}

?>

		
