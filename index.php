<?php include('submit.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Validation</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 20px;
            background-color: #007bff;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            max-width: 400px;
            margin: 0 auto;
            border: 2px solid black;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: large;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid black;
            border-radius: 4px;
        }

        .form-group select{
            width: 420px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 4px;
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .submit-btn, .display-btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .display-btn {
           margin-left:181px;
        }

        .submit-btn:hover, .display-btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
            display: none;
        }
    </style>

    <script>

        function display()
        {
          window.location.href = "http://localhost/ShivamProject/PHP Form/display.php";
        }

        function validateField(field) {
            var value = field.value;
            var errorElement = field.nextElementSibling;
            var isValid = true;

            if (field.name === "name") {
                var namePattern = /^[a-zA-Z\s]+$/;
                if (!namePattern.test(value)) {
                    errorElement.textContent = "Name must not contain numbers or special symbols.";
                    errorElement.style.display = "block";
                    isValid = false;
                }
            } else if (field.name === "contact") {
                var contactPattern = /^\d+$/;
                if (!contactPattern.test(value)) {
                    errorElement.textContent = "Contact must contain only digits.";
                    errorElement.style.display = "block";
                    isValid = false;
                }
            } else if (field.name === "email") {
                var emailParts = value.split('@');
                if (emailParts.length != 2 || emailParts[1].length < 3) {
                    errorElement.textContent = "Email must contain at least 3 characters after '@'.";
                    errorElement.style.display = "block";
                    isValid = false;
                }
            }

            if (isValid) {
                errorElement.style.display = "none";
                errorElement.textContent = "";
            }
        }

        function validateForm(event) {
            var isValid = true;

            var fields = document.querySelectorAll("input");
            fields.forEach(function(field) {
                validateField(field);
                if (field.nextElementSibling.style.display === "block") {
                    isValid = false;
                }
            });

            if (!isValid) {
                event.preventDefault();
            }

            return isValid;
        }

        window.onload = function() {
            var form = document.forms["myForm"];
            var fields = form.querySelectorAll("input");

            fields.forEach(function(field) {
                field.addEventListener("blur", function() {
                    validateField(field);
                });
            });

            form.onsubmit = function(event) {
                if (!validateForm(event)) {
                    event.preventDefault();
                }
            };
        };
    </script>
</head>
<body>
    <div class="form-container">
        <h1 style="color:#007bff"><center>Registration Details</center></h1>
        <form name="myForm" method="POST" action="index.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name">
                <div id="name-error" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender">
                    <option value="Not Selected">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <div id="gender-error" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="contact">Contact No:</label>
                <input type="text" name="contact">
                <div id="contact-error" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email">
                <div id="email-error" class="error-message"></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="pass">
                <div id="password-error" class="error-message"></div>
            </div>
            <button type="submit" class="submit-btn" name="btn">Submit</button>
            <button type="submit" class="display-btn" name="btn" onclick="return display()">
            Display records</button>
        </form>
    </div>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $query = "INSERT INTO user_info (Name,Gender,Contact,Email,Password)
     VALUES ('$name', '$gender', '$contact', '$email', '$pass')";
    $data = mysqli_query($conn, $query);

    if($data) {
        echo "<script>alert('Data inserted successfully');</script>";
    } else {
        echo "<h1>Error occurred while inserting the data</h1>";
    }

}
?>