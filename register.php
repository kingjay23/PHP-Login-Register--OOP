<?php
require 'core/init.php';
var_dump(Token::check(Input::get('token')));

if(Input::exists()){
	if(Token::check(Input::get('token')) )
	{
		$validate = new Validation();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),

			'password' => array(
				'required' => true,
				'min' => 6
			),

			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),

			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validate->passed()){
			echo "Passed";
		}
		else{
			foreach ($validate->errors() as $error) {
				echo $error, '<br />';
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<form action="" method="POST">
		<div class="field">
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
		</div>

		<div class="field">
		<label for="password">Password:</label>
			<input type="password" name="password" id="password">
		</div>

		<div class="field">
		<label for="password_again">Repeat Password:</label>
			<input type="password" name="password_again" id="password_again">
		</div>

		<div class="field">
		<label for="name">Name:</label>
			<input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>">
		</div>

		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Register me">
	</form>
</body>
</html>