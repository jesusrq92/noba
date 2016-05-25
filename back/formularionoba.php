<?php 

    //$db = mysqli_connect('localhost', '55eabdbec82b', '55eabdbec82bconcepth', 'ExitoBD'); //---- DB Beta ----
    //$db = mysqli_connect('localhost', 'root', 'root', 'ExitoBD');
    $db = mysqli_connect('localhost', 'root', 'root', 'NOBA_DB');
    if(mysqli_connect_errno())
    {
        echo 'Failed to connect to MySQL: '.mysqli_connect_error();
    }

 ?>

<?php


// require 'phpmailer/PHPMailerAutoload.php';


//     function enviaMail($nombre,$email,$hash){

//         //Template User Formulario
//         $templateUser = file_get_contents('MailUserForm.html');
//         $templateUser = str_replace('%name%', $nombre,$templateUser);
//         $templateUser = str_replace('%email%', $email,$templateUser);
//         $templateUser = str_replace('%hash%', $hash,$templateUser);

       
//         //Template Admin
//         $templateAdmin = file_get_contents('MailAdminForm.html');
//         $templateAdmin = str_replace('%name%', $nombre,$templateAdmin);
//         $templateAdmin = str_replace('%email%', $email,$templateAdmin);
//         $templateAdmin = str_replace('%hash%', $hash,$templateAdmin);

       

//         //Envia Mail Admin
//         $mail2 = new PHPMailer;
//         //$mail2->SMTPDebug = 3;
//         $mail2->isSMTP();
//         $mail2->Host = 'smtp.gmail.com';
//         $mail2->SMTPAuth = true;
//         $mail2->SMTPSecure = "tls";
//         //$mail2->Username = 'erik@concepthaus.mx'; //Mail para pruebas
//         //$mail2->Password = '';
//         $mail2->Username = 'franquiciasquality@gmail.com'; //se envia mail  a user desde este (solo se envia)
//         $mail2->Password = 'franquicias135';//se envia mail  a user desde este (solo se envia)
//         $mail2->Port = 587;
//         $mail2->setFrom('franquiciasquality@gmail.com','Exito Inmmobiliario');  //se envia mail  a user desde este (solo se envia)
//         //$mail2->setFrom('erik@concepthaus.mx','Erik Rodriguez'); //Pruebas se envía de este
//         $mail2->addAddress('franquiciasquality@gmail.com','Exito Inmobiliario'); //aqui llega el mail para el administrador
//         //$mail2->addAddress('erik@concepthaus.mx','Erik Rodriguez');// Aquí llega el correo en pruebas.
//         $mail2->isHTML(true);
//         $mail2->CharSet = 'UTF-8';
//         $mail2->Subject = 'Nuevo cliente'; 
//         $mail2->Body = $templateAdmin;
//         $mail2->send();

    
//         }
       


function  checkmailf1($correoo){
if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$correoo))
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


if(checkmailf1($correoo)){
     
    if(!is_numeric($nomm))
    {
    	if($longnom > 1)
{
	




				$sql="INSERT INTO ContactoForm(`id`, `nombre`,`telefono`,`correo`,`giro_empresa`,`estado_republica`,`msj`) VALUES
				('','$nomm','$tl','$cor','se1','se2','mj')";
			    $saveDB = mysqli_query($sql);
				if($saveDB){

                    // enviaMail($nomm,$correoo,$hash);
							echo "<div id='Ajx'><script>document.getElementById('f1').reset(); </script> 
							<script>document.getElementById('f2').reset(); </script> 
												<script>swal({   title: 'Datos guardados con éxito, te hemos enviado un correo con el link al cuestionario y video.',   text: '¡Da click en el boton OK para ver el video!',   type: 'success',   showCancelButton: true,   confirmButtonColor: '#a3db63',   confirmButtonText: 'OK',   closeOnConfirm: true},function(){
													window.open('/exitoinm/cuestionario/respuesta.php?correo=$correoo&hash=$hash&nombre=$nomm','_blank' ); 
												}); </script></div>"; //En este script de swal incrustamos otro de jquery para direccionar a otra pagina.
                                               

                                               //poner inm

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
	<script>sweetAlert({title:'Error',text:'Datos incompletos',confirmButtonColor:'#F06060',type:'error'});</script></div>";
}


		 ?>

		
