<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Student Management System</title>

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --sidebar-width: 250px;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            background: var(--primary-color);
            color: white;
            text-align: center;
            font-weight: 600;
        }
        
        .sidebar-menu {
            padding: 0;
            list-style: none;
        }
        
        .sidebar-menu li {
            position: relative;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu a:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }
        
        .sidebar-menu a.active {
            background-color: rgba(67, 97, 238, 0.2);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
            font-weight: 500;
        }
        
        .sidebar-menu a i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        .sub-menu {
            padding-left: 1.5rem;
            list-style: none;
            display: none;
        }
        
        .sub-menu a {
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .sub-menu a:hover {
            color: var(--primary-color);
        }
        
        .sub-menu a:before {
            content: "→";
            margin-right: 10px;
            font-size: 0.8rem;
        }
        
        .menu-item.has-submenu > a:after {
            content: "\f282";
            font-family: "bootstrap-icons";
            margin-left: auto;
            transition: transform 0.3s;
        }
        
        .menu-item.has-submenu.active > a:after {
            transform: rotate(90deg);
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .navbar {
            padding: 1rem 1.5rem;
            background: white !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .navbar-toggler {
                display: block;
            }
        }
        
        .sidebar-toggler {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-color);
            cursor: pointer;
        }
        
        @media (max-width: 992px) {
            .sidebar-toggler {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h4>Course Training Centre</h4>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="menu-item has-submenu">
                    <a href="#">
                        <i class="bi bi-people"></i>
                        <span>Students</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('students.index') }}">All Students</a></li>
                        <li><a href="{{ route('enrollments.index') }}">Enrollments</a></li>
                        <li><a href="{{ route('payments.index') }}">Payments</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/teachers')}}">
                        <i class="bi bi-person-badge"></i>
                        <span>Teachers</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/courses')}}">
                        <i class="bi bi-book"></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/batches')}}">
                        <i class="bi bi-collection"></i>
                        <span>Batches</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('/attendances')}}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Attendances</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content w-100">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <div class="container-fluid">
                    <button class="sidebar-toggler me-3">
                        <i class="bi bi-list"></i>
                    </button>
                    <a class="navbar-brand" href="#">
                        <h4 class="mb-0"> Course Training Centre</h4>
                    </a>
                </div>
            </nav>

            <!-- Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.sidebar-toggler').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Toggle submenus
        document.querySelectorAll('.menu-item.has-submenu > a').forEach(item => {
            item.addEventListener('click', function(e) {
                if (window.innerWidth > 992) {
                    e.preventDefault();
                    const parent = this.parentElement;
                    parent.classList.toggle('active');
                    
                    const submenu = this.nextElementSibling;
                    if (submenu.style.display === 'block') {
                        submenu.style.display = 'none';
                    } else {
                        submenu.style.display = 'block';
                    }
                }
            });
        });
        
        // Auto close submenus when clicking elsewhere
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.menu-item.has-submenu')) {
                document.querySelectorAll('.sub-menu').forEach(menu => {
                    menu.style.display = 'none';
                    menu.parentElement.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html>