<?php
if (isset($_POST['post_submit'])) {
    $error = false;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'gif', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $newFileName = 'person_image.' . $fileExtension;
            if (move_uploaded_file($fileTmpPath, $newFileName)) {
                $error = false;
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }

    if ($error) {
        header('Location: /');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eat Mubarak - HR Announcement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700,900" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .bg-theme-primary {
            background-color: #d81f27;
            border-color: #d81f27;
        }

        .theme-content {
            position: fixed;
            height: 70% !important;
            margin: 0 100px;
            left: 0;
            right: 0;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .theme-content .icon {
            transform: rotateZ(-15deg);
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 150px;
            opacity: 0.3;
        }

        .bottom-logo {
            height: 60px;
        }

        .title {
            margin-top: 2.5rem !important;
            font-weight: 600;
        }

        .footer {
            position: fixed;
            margin: 0 90px;
            left: 0;
            right: 0;
        }

        .main-img {
            height: 300px;
        }

        .congrats-text {
            font-size: 20px;
        }

        .marker {
            width: 10px;
        }
    </style>
</head>

<body class="w-100">
    <?php if (!isset($_POST['post_submit'])) { ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-2">
                <form autocomplete="off" class="mt-5" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    Name
                                </div>
                            </div>
                            <input required name="fullname" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    Position
                                </div>
                            </div>
                            <input required name="position" class="form-control" placeholder="Position">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    City
                                </div>
                            </div>
                            <select required class="form-control" name="city">
                                <option>Karachi</option>
                                <option>Lahore</option>
                                <option>Islamabad</option>
                                <option>Faisalabad</option>
                                <option>Rawalpindi</option>
                                <option>Hyderabad</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    Gender
                                </div>
                            </div>
                            <div class="form-control">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="maleGender" name="gender" value="Him" required>
                                    <label class="form-check-label" for="maleGender">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="femaleGender" name="gender" value="Her" required>
                                    <label class="form-check-label" for="femaleGender">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    Description
                                </div>
                            </div>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    Image
                                </div>
                            </div>
                            <input type="file" class="form-control form-control-file" name="image" accept="image/*" required>
                        </div>
                    </div>
                    <button type="submit" name="post_submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="heading">
        <h1 class="title text-center"><?= $_POST['position'] ?? "" ?></h1>
    </div>
    <div class="bg-theme-primary theme-content rounded shadow">
        <div class="inner-body my-5 mx-4">
            <div class="row">
                <div class="mx-2 text-center">
                    <img class="main-img img-fluid" src="<?= $newFileName ?>" />
                </div>
                <div class="col text-white mr-4">
                    <div>
                        <span class="float-right my-2">Location: <?= $_POST['city'] ?? "" ?></span>
                        <h4><?= $_POST['fullname'] ?? "" ?></h4>
                    </div>
                    <hr class="mb-2">
                    <p><?= $_POST['position'] ?? "" ?></p>
                    <p class="font-weight-bold text-dark"><?= $_POST['description'] ?? "" ?></p>
                    <p class="font-weight-bold congrats-text">
                        Please extend your support and congratulate him/her in the new role.
                    </p>

                </div>
            </div>
            <img class=" icon img-fluid" src="announcement-logo.svg" />
        </div>
    </div>
    <div class="fixed-bottom pb-5 footer">
        <img class="img-fluid bottom-logo float-left" src="em_logo_or.png" alt="Eat Mubarak">
        <img class="img-fluid bottom-logo float-right" src="hr-test-logo.png" alt="Eat Mubarak">
    </div>
    <?php } ?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <?php if (isset($_POST['post_submit'])) { ?>
        <script>
            html2canvas(document.body).then(canvas => {
                var img = canvas.toDataURL("image/png");
                var dlLink = document.createElement('a');
                dlLink.download = "<?= $_POST['fullname'] . " - " . $_POST['position'] ?? "" ?>.png";
                dlLink.href = img;
                dlLink.click();
            });
        </script>
    <?php } ?>
</body>
</html>