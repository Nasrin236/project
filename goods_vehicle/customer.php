<?php
session_start(); //to start the session
include 'connection.php';
include "commonbase.php";
?>
<style>
    td,th{
        padding:10px;
    }
</style>
<center>
<br><br>
<div>
    <form method="POST">
        <hr><h3>Customer Registration</h3><hr>
        <table >
            <tr>
                <td>Name</td>
                <td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtName" required=""></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><textarea class="form-control" name="txtAddress" required=""></textarea></td>
            </tr>
            <tr>
                    <td>District</td>
                    <td><select name="dist" class="form-control">
                        <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                        <option value="Kollam">Kollam</option>
                        <option value="Pathanamthitta">Pathanamthitta</option>
                        <option value="Alappuzha">Alappuzha</option>
                        <option value="Idukki">Idukki</option>
                        <option value="Kottayam">Kottayam</option>
                        <option value="Ernakulam">Ernakulam</option>
                        <option value="Thrissur">Thrissur</option>
                        <option value="Palakkad">Palakkad</option>
                        <option value="Malappuram">Malappuram</option>
                        <option value="Kozhikode">Kozhikode</option>
                        <option value="Wayanad">Wayanad</option>
                        <option value="Kannur">Kannur</option>
                        <option value="Kasargod">Kasargod</option>
                    </select></td>
                </tr>
            <tr>
                <td>Contact</td>
                <td><input type="text" class="form-control" pattern="[6789][0-9]{9}" name="txtContact" required=""></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" class="form-control" name="txtEmail" required=""></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="Password" class="form-control" name="txtPwd" required=""></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" style="width:300px;" class="btn btn-primary" name="btnSubmit" required=""></td>
            </tr>
        </table>
    </form>
</div>
</center>
<?php
if (isset($_REQUEST['btnSubmit'])) {
    $name = $_REQUEST['txtName'];
    $address = $_REQUEST['txtAddress'];
    $contact = $_REQUEST['txtContact'];
    $dist = $_REQUEST['dist'];
    $email = $_REQUEST['txtEmail'];
    $pwd = $_REQUEST['txtPwd'];

    $q = "select count(*) from login where username='$email'";
    $s = mysqli_query($conn, $q);
    $r = mysqli_fetch_array($s);
    if ($r[0] > 0)    //to check whether the username exist
    {
        echo '<script>alert("Email already registered")</script>';
        echo '<script>location.href="index.html"</script>';
    } else {
        $q = "insert into customer (name,address,email,phone,district) values('$name','$address','$email','$contact','$dist')";
        $s = mysqli_query($conn, $q);
        if ($s) {

            $q = "insert into login (username,password,usertype,status) values('$email','$pwd','user','1')";
            $s = mysqli_query($conn, $q);
            if ($s) {
                echo '<script>alert("Registration successful.")</script>';
                echo '<script>location.href="login.php"</script>';
            } else {
                echo '<script>alert("Sorry som error occured")</script>';
                // echo '<script>location.href="index.php"</script>';

            }
        } else {
            echo '<script>alert("Sorry some error occured")</script>';
            // echo '<script>location.href="index.php"</script>';
            echo $q;
        }
    }
}
?>