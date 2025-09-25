<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "viva_absen_training");

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function GetUsers()
{
    $users = query("SELECT 
                        u.id,
                        u.name,
                        u.nik,
                        u.password,
                        r.name as role,
                        u1.name as created_by,
                        u.created_at,
                        u2.name as updated_by,
                        u.updated_at,
                        u.active
                    FROM users u
                        INNER JOIN roles r ON u.role_id = r.id
                        INNER JOIN users u1 on u.created_by = u1.id
                        INNER JOIN users u2 on u.updated_by = u2.id
                    -- WHERE u.active = 'y'
                    ORDER BY u.created_at ASC
    ");
    
    return $users; 
}

function GetRoleOptions()
{
    return query("SELECT * FROM roles WHERE active = 'y' ORDER BY name ASC");
}
?>