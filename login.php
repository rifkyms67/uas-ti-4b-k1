<!-- views/login.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="w-100 d-flex align-items-center" style="height: 100vh;">
    <div class="container-fluid">
        <h2 class="text-center">LOGIN</h2>
        <div class="d-flex justify-content-center">
            <form action="index.php?action=login" method="post" class="p-4 m-2 border border-1 rounded-lg shadow-lg">
                <label for="username">Username:</label><br>
                <input class="form-control mb-1" type="text" id="username" name="username" required>
                <label for="password">Password:</label><br>
                <input class="form-control mb-4" type="password" id="password" name="password" required>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>