
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Payment File</title>

    <!-- Bootstrap CSS CDN -->
    <link 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
        rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #d0e0f0;
        }
        .full-background {
            height: 100%;
            width: 100%;
            display: block;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            background: #ffffff;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
        }
        .form-group {
            flex: 0 0 48%;
        }
        .btn-primary {
            width: 100%;
        }
        .button-row {
            display: flex;
            justify-content: space-between; /* Adjusts spacing */
            gap: 10px; /* Adds space between buttons */
        }

    </style>
</head>
<body>

    <div class="full-background">
        <div class="form-container">
            <h2 class="text-center mb-4">Generate Payment File</h2>
            <form method="post" action="generate_payment_file_method.php" enctype="multipart/form-data">
                <div class="form-row mb-3">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="form-group">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" step="0.01" name="price" id="price" placeholder="Enter price" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" required>
                    </div>
                </div>

                <div class="form-row mb-3">
                    <div class="form-group">
                        <label for="idnumber" class="form-label">ID number</label>
                        <input type="number" class="form-control" step="0.01" name="idnumber" id="idnumber" placeholder="Enter ID number" required>
                    </div>
                    <div class="form-group">
                        <label for="id_picture" class="form-label">Upload ID Picture</label>
                        <input type="file" class="form-control-file" name="id_picture" id="id_picture" accept="image/*" required>
                    </div>
                </div>

                <div class="button-row">
                    <button type="submit" name="action" value="generate" class="btn btn-primary">FIRST INVESTMENT FUND CONTRACT</button>
                    <button type="submit" name="action" value="download" class="btn btn-primary">MODARABA CONTRACT</button>
                </div>

            </form>
        </div>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <script 
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script 
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script 
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

