<?php
// logout.php

session_start();        // Mulai sesi
session_unset();        // Hapus semua data sesi
session_destroy();      // Hancurkan sesi
header('Location: /motor_sales/login'); // Redirect ke halaman login
exit;
