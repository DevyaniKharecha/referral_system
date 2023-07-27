<?php
        require '../model/patients.php';
        session_start();             
        $sporttb=isset($_SESSION['sporttbl0'])?unserialize($_SESSION['sporttbl0']):new patients();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="../libs/bootstrap.css">
    <style type="text/css">
    .wrapper {
        width: 500px;
        margin: 0 auto;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Patient</h2>
                    </div>
                    <p>Please fill this form and submit to add patient record in the database.</p>
                    <form action="../index.php?act=add" method="post">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <select id="title" name="title" class="form-control">
                                <option disabled value="none">Select Title</option>
                                <option <?php echo ($sporttb->title == "Mr")? 'selected=selected': ''; ?> value="Mr">
                                    Mr</option>
                                <option <?php echo ($sporttb->title == "Mrs")? 'selected=selected': ''; ?> value="Mrs">
                                    Mrs</option>
                                <option <?php echo ($sporttb->title == "Ms")? 'selected=selected': ''; ?> value="Ms">
                                    Ms</option>
                                <option <?php echo ($sporttb->title == "Miss")? 'selected=selected': ''; ?>
                                    value="Miss">Miss</option>
                                <option <?php echo ($sporttb->title == "Dr")? 'selected=selected': ''; ?> value="Dr">
                                    Dr</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="first_name" placeholder="First Name">First Name:</label>
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                placeholder="First Name" value="<?php echo $sporttb->first_name; ?>">
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname:</label>
                            <input type="text" id="surname" name="surname" class="form-control" placeholder="Surname"
                                value="<?php echo $sporttb->surname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="dob" placeholder="Date of Birth">Date of Birth:</label>
                            <input type="date" id="dob" name="dob" class="form-control"
                                value="<?php echo $sporttb->dob; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                value="<?php echo $sporttb->email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input type="tel" id="contact" name="contact" class="form-control"
                                placeholder="Mobile Phone" value="<?php echo $sporttb->contact; ?>">
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="street" name="street" placeholder="Enter Street"
                                value="<?php echo $sporttb->street; ?>">
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" id="borough" name="borough"
                                    placeholder="Borough" value="<?php echo $sporttb->borough; ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                    value="<?php echo $sporttb->city; ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="postcode" name="postcode"
                                    placeholder="Enter Postcode" value="<?php echo $sporttb->postcode; ?>">
                            </div>
                            <div class="form-group form-check">
                                <input type="hidden" name="referred" value="0">
                                <input type="checkbox" class="form-check-input" id="referred" name="referred" value="<?php echo $sporttb->referred; ?>">
                                <label class="form-check-label" for="referred">Referred</label>
                            </div>
                        </div>
                        <br>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function updateReferredValue(checkbox) {
        var referredInput = document.getElementsByName("referred")[0];
        if (checkbox.checked) {
            referredInput.value = "1";
        } else {
            referredInput.value = "0";
        }
    }
</script>
In this code, I made

</html>
