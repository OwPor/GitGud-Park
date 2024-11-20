<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
        }

        #profileImage {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
            background-color: #f5f5f5;
        }

        #uploadButton {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #uploadButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Upload Profile Image</h2>
    <img id="profileImage" src="assets/images/profile.jpg" alt="Profile Image">
    <input type="file" id="fileInput" style="display: none;" accept="image/*">
    <button id="uploadButton">Upload Image</button>

    <script>
        const fileInput = document.getElementById('fileInput');
        const profileImage = document.getElementById('profileImage');
        const uploadButton = document.getElementById('uploadButton');

        uploadButton.addEventListener('click', () => {
            fileInput.click(); // Trigger the file input when button is clicked
        });

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0]; // Get the selected file
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    profileImage.src = e.target.result; // Update the image source
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            }
        });
    </script>
</body>
</html>
