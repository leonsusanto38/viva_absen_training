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

function GetUserById($id)
{
    $users = query("SELECT 
                        u.id,
                        u.name,
                        u.nik,
                        u.password,
                        u.role_id,
                        u1.name as created_by,
                        u.created_at,
                        u2.name as updated_by,
                        u.updated_at,
                        u.active
                    FROM users u
                        INNER JOIN users u1 on u.created_by = u1.id
                        INNER JOIN users u2 on u.updated_by = u2.id
                    -- WHERE u.active = 'y'
                    WHERE u.id = $id
                    ORDER BY u.created_at ASC
    ");
    
    return $users; 
}

function GetRoleOptions()
{
    return query("SELECT * FROM roles WHERE active = 'y' ORDER BY name ASC");
}

function CreateUser($data)
{
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $nik = htmlspecialchars($data["nik"]);
    $password = $data["password"] ? htmlspecialchars(mysqli_real_escape_string($data["password"])) : "password123";
    $role = $data["role"];
    $active = $data["active"];

    // echo $name.$nik.$password.$role.$active;
    
    $query = "INSERT INTO USERS(
                name,
                nik,
                password,
                role_id,
                created_by,
                created_at,
                updated_by,
                active
            ) VALUES(
                '$name',
                '$nik',
                '$password',
                $role,
                1,
                current_timestamp(),
                1,
                '$active'
            )
    ";

    try {
        mysqli_query($conn, $query);
        return true;
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Duplicate entry
            return "NIK sudah terdaftar!";
        }
        return "Terjadi kesalahan: " . $e->getMessage();
    }
}

function UpdateUser($data)
{
    global $conn;
    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $nik = htmlspecialchars($data["nik"]);
    $password = htmlspecialchars($data["password"]);
    $updated_by = $data["updated_by"];
    $role = $data["role"];
    $active = $data["active"];

    $query = "UPDATE USERS SET
                name = '$name',
                nik = '$nik',
                password = '$password',
                updated_by = '$updated_by',
                updated_at = current_timestamp(),
                role_id = $role,
                active = '$active'
            WHERE id = $id
    ";

    try {
        mysqli_query($conn, $query);
        return true;
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Duplicate entry
            return "NIK sudah terdaftar!";
        }
        return "Terjadi kesalahan: " . $e->getMessage();
    }
}

function DeleteUser($id)
{
    global $conn;
    $query = "DELETE FROM USERS WHERE id = $id";
    try {
        mysqli_query($conn, $query);
        return true;
    } catch (mysqli_sql_exception $e) {
        return "Terjadi kesalahan: " . $e->getMessage();
    }
}

function GetRoles()
{
    return query("SELECT * FROM roles ORDER BY name ASC");
}

function SearchUsers($key)
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
                    WHERE 1 = 1
                        AND u.name like '%$key%'
                            OR u.nik like '%$key%'
                    ORDER BY u.created_at ASC
    ");
    
    return $users; 
}

?>