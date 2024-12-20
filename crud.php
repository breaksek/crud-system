<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application (Admin Only)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            text-align: center;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }
        .sidebar ul li a:hover {
            background-color: #575757;
        }
        .container {
            flex: 1;
            padding: 20px;
            background: #fff;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-group button:hover {
            background-color: #4cae4c;
        }
        .btn-delete {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-delete:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    // Simulate login check (replace with real authentication in production)
    $_SESSION['role'] = 'admin'; // Change to 'user' to simulate non-admin access

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        echo "<div class='container'><h1>Access Denied</h1><p>You must be an admin to access this page.</p></div>";
        exit;
    }
    ?>

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Manage Users</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>

    <div class="container">
        <h1>CRUD Application</h1>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <button onclick="addEntry()">Add</button>
        </div>
        <table id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be added here -->
            </tbody>
        </table>
    </div>

    <script>
        let data = [];

        function addEntry() {
            const nameInput = document.getElementById('name');
            const name = nameInput.value.trim();

            if (!name) {
                alert('Please enter a name.');
                return;
            }

            data.push(name);
            nameInput.value = '';
            renderTable();
        }

        function deleteEntry(index) {
            data.splice(index, 1);
            renderTable();
        }

        function renderTable() {
            const tbody = document.getElementById('data-table').querySelector('tbody');
            tbody.innerHTML = '';

            data.forEach((name, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${name}</td>
                    <td>
                        <button class="btn-delete" onclick="deleteEntry(${index})">Delete</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }
    </script>
</body>
</html>
