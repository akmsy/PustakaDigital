<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Pustaka Digital</title>
</head>
<body style="background-color: #3a47bf;">
    <main>
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <form action="proses_login.php" method="POST" class="shadow p-5 bg-body-tertiary rounded w-50">
                <div class="text-center mb-4">
                    <h1>Pustaka Digital</h1>
                    <span class="fw-bold">Sistem Perpustakaan Nasional</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
            
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Masuk</button> 
                </div>
            </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</html>