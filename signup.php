<?php
    require_once "conndb.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        displayContent("signup.pug");
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        handleSignup();
    }

    function handleSignup() {
        $conn = connect();
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            if ($row["id"]) {
                echo "<script>alert('Username already exists');</script>";
                echo "<script>window.location.href='/signup'</script>";
                die();
            }
        }

        $stmt = $conn->prepare("INSERT into users (username, password, rights) 
        VALUES (?, ?, ?)");
        $rights = 0;
        $stmt->bind_param("ssi", $username, $password, $rights);
        $res = $stmt->execute();

        if ($res) {
            echo "<script>window.location.href='/login'</script>";
        } else {
            echo "<script>alert('An error occured');</script>";
            echo "<script>window.location.href='/signup'</script>";
            die();
        }
    }
?>