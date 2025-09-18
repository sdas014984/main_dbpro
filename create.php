<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
if (isset($_POST['submit'])) {
	require "config.php";
	require "common.php";

if (isset($_POST['Submit'])) 
  if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_user = array(
			"firstname" => $_POST['firstname'],
			"lastname"  => $_POST['lastname'],
			"email"     => $_POST['email'],
			"age"       => $_POST['age'],
			"location"  => $_POST['location']
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_user);
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php require "header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php } ?>

<h2>Add a user</h2>

<form method="post">
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" id="firstname"><br>
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname"><br>
	<label for="email">Email Address</label>
	<input type="text" name="email" id="email"><br>
	<label for="age">Age</label>
	<input type="text" name="age" id="age"><br>
	<label for="location">Location</label>
	<input type="text" name="location" id="location"><br>
	<input type="submit" name="submit" value="Submit">

</form>

<a href="frame_3.html" target="index">Back to home</a>
<input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
<?php require "footer.php"; ?>