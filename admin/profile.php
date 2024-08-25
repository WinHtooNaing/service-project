<?php
include 'header.php';
$stmt = $pdo->prepare('select * from users where id=1');
$stmt->execute();
$result = $stmt->fetch();
if ($_POST) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        if (empty($username)) {
            $usernameErr = "invalid name";
        }
        if (empty($email)) {
            $emailErr = "invalid email";
        }
        if (empty($password)) {
            $passwordErr = "invalid password";
        }
        if (empty($confirm_password)) {
            $confirm_passwordErr = "invalid confirm password";
        }
    } else if ($password != $confirm_password) {
        $confirm_passwordErr = "Passwords do not match";
    } else {
        $passwordConfirm = password_hash($password, PASSWORD_DEFAULT);
        $stmtupdate = $pdo->prepare("update users set username='$username',email='$email', password='$passwordConfirm' where id=1 ");
        $result = $stmtupdate->execute();
        if ($result) {
            echo "<script>alert('Update Success');window.location.href='logout.php'</script>";
        }
    }
}
?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row mt-sm-4" style="display: flex;justify-content:center">

                <div class="col-12 col-md-12 col-lg-8 ">
                    <form method="post" action="" class="needs-validation">
                        <div class="card-header">
                            <h4>Edit Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Your Name</label>
                                    <input type="text" class="form-control" value="<?php echo $result['username'] ?>" name="username">
                                    <div class="invalid-feedback">
                                        Please fill your name
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="<?php echo $result['email'] ?>" name="email">
                                    <div class="invalid-feedback">
                                        Please fill in the email
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="form-group col-md-6 col-6">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" value="" name="password">
                                    <div class="invalid-feedback">
                                        Please fill your new password
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-6">
                                    <label>New Confirm Password</label>
                                    <input type="password" class="form-control" value="" name="confirm_password">
                                    <div class="invalid-feedback">
                                        Please fill your new password
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="form-group mb-0 col-12">
                                    <div class="custom-control custom-checkbox">

                                        <div class="text-muted form-text">
                                            You will get new information about products, offers and promotions
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include 'footer.php';

?>