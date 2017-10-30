<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author Lucas Gullaci
 */
class Email {
    
    private $port;
    private $smtp;
    private static $bodyEmailProposta;

    public static function enviarEmailProposta($nome, $email, $telefone1, $telefone2, $proposta ){

    	try{
	    	$config = Config::GetInstance();
	    	$mail = new PHPMailer;
			$mail->Charset   = "UTF-8";
			$mail->isSMTP(); 
			//$mail->SMTPDebug = 1;
			
			$mail->Host = "smtp.gullaciconsultoria.com.br"; //$config->prefrences["smtp_server"];  
			$mail->SMTPAuth = true;                            
			$mail->Username = "contato@gullaciconsultoria.com.br";//$config->prefrences["smtp_user"];     
			$mail->Password = "nkr5vdyi";//$config->prefrences["smtp_senha"];
			$mail->Port = "587";//$config->prefrences["smtp_port"];
			//$mail->SMTPSecure = 'tls';

	    	ob_start();

	            include 'Email/EmailProposta.php';

	        self::$bodyEmailProposta = ob_get_contents();

	        ob_end_clean();

	        self::$bodyEmailProposta = str_replace('#nome', $nome, self::$bodyEmailProposta);
         	self::$bodyEmailProposta = str_replace('#email', $email, self::$bodyEmailProposta);
         	self::$bodyEmailProposta = str_replace('#telefone1', $telefone1, self::$bodyEmailProposta);
         	self::$bodyEmailProposta = str_replace('#telefone2', $telefone2, self::$bodyEmailProposta);
         	self::$bodyEmailProposta = str_replace('#proposta', $proposta, self::$bodyEmailProposta);

	        $mail->setFrom('contato@gullaciconsultoria.com.br', 'Contato');	
	        $mail->addAddress('lucas.gullaci@gullaciconsultoria.com.br', 'Lucas Gullaci'); 
	        $mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Nova Proposta';
			$mail->Body    = self::$bodyEmailProposta;
			
			if($mail->send())
			{
				echo "E-mail enviado com sucesso";
			}else
			{
				echo $mail->ErrorInfo;
			}
			

	   
		}catch(Exception $e)
		{
			echo $e->getMessage();
		}
		

    }
    
}
