<?php

$password = "";
$hashedPassword = "";
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["password"])) {
        $password = $_POST["password"];
    }

    if (isset($_POST["hash"])) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        echo ""; 
    }

    if (isset($_POST["verify"])) {

        if (isset($_POST["hashed"])) {
            $hashedPassword = $_POST["hashed"];
        }

        if ($password != "" && $hashedPassword != "") {
            $check = password_verify($password, $hashedPassword);

            if ($check) {
                $result = "match";
            } else {
                $result = "no match";
            }
        } else {
            $result = "missing data";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Password Hashing - Assignment 2</title>
</head>
<body>

<h2>PHP Password Hashing Assignment 2</h2>

<form method="post">

    <label>Password (Plaintext):</label><br>
    <input type="text" name="password" value="<?php echo htmlspecialchars($password); ?>" style="width: 300px;">
    <br><br>

    <label>Hashed Password:</label><br>
    <textarea name="hashed" rows="4" cols="60"><?php echo htmlspecialchars($hashedPassword); ?></textarea>
    <br><br>

    <input type="submit" name="hash" value="Hashing">
    <input type="submit" name="verify" value="Verify">

</form>

<hr>

<?php if ($hashedPassword != "" && isset($_POST["hash"])) { ?>
    <p><b>Hash Result:</b></p>
    <p><?php echo htmlspecialchars($hashedPassword); ?></p>
<?php } ?>

<?php if ($result != "") { ?>
    <p><b>Verify Result:</b> <?php echo htmlspecialchars($result); ?></p>
<?php } ?>

</body>
</html>
