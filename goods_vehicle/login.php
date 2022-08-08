<?php //
include 'connection.php';
include 'commonbase.php';
?>
<style>
    td,
    th {
        padding: 10px;
    }
</style>
<center>
    <br><br>
<form  method="POST" enctype="multipart/form-data">

    <table >
        
        <hr><h2 align="center"> <b>Login</b></h2><hr>
        <tr>
            <td><b>Email :</b></td>
            <td><input type="email" name="email" required="" class="form-control" /></td>
        </tr>
        <tr>
            <td><b>Password :</b></td>
            <td><input type="password" name="pwd" required="" class="form-control" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="LOGIN" class="btn btn-primary" /></td>
        </tr>
    </table>

</form>
</center>
<?php

if (isset($_POST['submit'])) {


    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $qry = "select count(*) from login where lcase(username)='$email'";
    $res = mysqli_query($conn, $qry);
    $row = mysqli_fetch_array($res);

    if ($row[0] > 0) {

        $qry = "select * from login where lcase(username)='$email'";
        $res = mysqli_query($conn, $qry);
        $row = mysqli_fetch_array($res);
        if ($row['password'] == $pwd) {
            session_start();
            $_SESSION['email'] = $email;
            if ($row['status'] == '1') {
                if ($row['usertype'] == 'admin')
                    echo '<script>location.href="admin/adminhome.php"</script>';
                else if ($row['usertype'] == 'user') {
                    echo '<script>location.href="user/userhome.php"</script>';
                } elseif ($row['usertype'] == 'driver') {
                    echo '<script>location.href="driver/driverhome.php"</script>';
                } else {
                    echo '<script>alert(" Account inactive");</script>';
                }
            } else {

                echo '<script>alert(" incorrect password ....");</script>';
            }
        } else {

            echo '<script>alert(" User doesnt exist ....");</script>';
        }
    }
}
?>