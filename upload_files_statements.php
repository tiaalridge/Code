<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Statement Upload</title>
    <style>
        body {
            font-family: "Roboto", sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .btn-row {
            display: flex;
            width: 100%;
            justify-content: center;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            flex: 1;
            margin: 0 5px;
            text-align: center;
            max-width: 150px;
            font-size: 16px;
        }

        .btn.submit-btn {
            text-align: center;
        }

        #fileInput {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="btn-row">
            <button class="btn" onclick="openFileInput()">File</button>
            <label for="fileInput" class="btn">Upload Bank Statements</label>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <input type="file" id="fileInput" name="bankStatements" accept=".pdf,.csv,.xlsx" required>
            <br><br>
            <input type="submit" value="Submit" class="btn submit-btn">
        </form>
    </div>
    <script>
        function openFileInput() {
            document.getElementById("fileInput").click();
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_FILES["bankStatements"]) && $_FILES["bankStatements"]["error"] === UPLOAD_ERR_OK) {
            $targetDir = "uploads/"; // Specify the directory to store uploaded files
            $fileName = basename($_FILES["bankStatements"]["name"]);
            $targetPath = $targetDir . $fileName;

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["bankStatements"]["tmp_name"], $targetPath)) {
                // File uploaded successfully
                echo "File uploaded successfully.";
            } else {
                // Error occurred while uploading the file
                echo "Error uploading the file.";
            }
        } else {
            // No file uploaded or an error occurred during upload
            echo "Please select a valid file to upload.";
        }
    }
    ?>
</body>

</html>