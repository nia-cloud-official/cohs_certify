<?php 

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

?> 
<head>
    <title>COHS Certificate System</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <style>
        button {
            color: black;
        }
    </style>
    <nav>
        <div><strong>Certify</strong></div>
        <div class="flex items-center gap-2">
            <a href="logout.php">
                <button
                    class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#FACC14] h-9 rounded-md px-3">
                    Logout
                </button>
            </a>
        </div>

    </nav>
    <div class="container">
        <div class="card">
            <h2>Welcome to Certify</h2>
            <p>Manage and verify certificates with ease.</p>
            <br>
            <center>
                <div class="flex items-center gap-2">
                    <a href="create.php">
                        <button
                            class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#60A5FA] h-9 rounded-md px-3">
                            Record
                        </button>
                    </a>
                    <a href="verify.php">

                        <button
                            class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#FB923C] h-9 rounded-md px-3">
                            Verify
                        </button>
                    </a>
                    <a href="settings.php">
                        <button
                            class="cursor-pointer bg-white relative inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-[#F5F5F5] hover:text-[#FACC14] h-9 rounded-md px-3">
                            Settings
                        </button>
                    </a>
                </div>
            </center>
        </div>
    </div>
</body>

</html>