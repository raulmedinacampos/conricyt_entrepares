<style type="text/css">
/* estilos para login */
#login-entre-pares { position:relative; margin:auto; width:300px; max-width:300px; height:120px; max-height:120px; line-height:40px; padding:10px;  border:#CCC 3px solid; text-align: right; background-color:#666; color:#FFF; margin-top:50px; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;  box-shadow: 5px 5px 0 #333; -webkit-box-shadow: 5px 5px 10px #333; -moz-box-shadow:50px 50px  #333; }

#username, #password, btn_login { border:#CCC 1px solid; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius: 15px;}
</style>
<?php
	$attr = array(
				  'id'		=>	'login-entre-pares',
				  'name'	=>	'login-entre-pares'
				  );
	echo form_open(base_url().'registro/checkLogin', $attr);
	echo form_label('Usuario ');
	$attr = array(
				  'id'		=>	'username',
				  'name'	=>	'username'
				  );
	echo form_input($attr);
	echo '<br />';
	echo form_label('Contraseña ');
	$attr = array(
				  'id'		=>	'password',
				  'name'	=>	'password'
				  );
	echo form_password($attr);
	echo '<br />';
	$attr = array(
				  'id'		=>	'btn_login',
				  'name'	=>	'btn_login',
				  'value'	=>	'Entrar'
				  );
	echo form_submit($attr);
	echo form_close();
?>