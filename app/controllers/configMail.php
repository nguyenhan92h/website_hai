<?php
	class configMail{
		public static function setUserConfig(){
			$mail = Settings::select(array('email_send', 'password_email'))->first();
			$config = array(
			  'driver' => 'smtp',
			  'host' => 'smtp.gmail.com',
			  'port' => '587',
			  'from' => array('address' => $mail->email_send, 'name' => 'NongTungPhut'),
			  'encryption' => 'tls',
			  'username' => $mail->email_send,
			  'password' => Crypt::decrypt($mail->password_email),
			  'sendmail' => '/usr/sbin/sendmail -bs',
			  'pretend' => false
			  );
			Config::set('mail',$config);
		}
	}