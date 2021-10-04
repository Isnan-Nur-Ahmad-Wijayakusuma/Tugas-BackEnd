<?php
//KONEKSI MySQL & Kita butuh parameter di dlm FUNC ini
$conn = mysqli_connect("localhost","root","","warcaf");

function query($query){
    global $conn;   #Ngecek apakah ada var ini di file ini?
    #$query diambil dr atas ini
    $result = mysqli_query($conn, $query); #$result adalah lemari/DB
    $rows = [];                            #Wadah kosong bernama rows
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;                    #Memasukkan kewadah kosong
    }
    return $rows;                          #Mengembalikan wadah/membawa kotaknya
}

function registrasi($data){
    global $conn;
    
    #user td dpt menulis slash & membuat inputan user dengan huruf biasa/tdk kapital
    $Nama     = strtolower(htmlspecialchars($data["Nama"]));
    $Gender   = strtoupper(htmlspecialchars($data["Gender"]));
    $Email    = htmlspecialchars($data["Email"]);
    $Username = strtolower(htmlspecialchars($data["Username"]));

    #user dpt menulis seluruh jenis karakter
    $Pass  = mysqli_real_escape_string ($conn,$data["Pass"]);
    $Pass2 = mysqli_real_escape_string ($conn,$data["Pass2"]);

    #bn ra dihack/dileboni angger code
    $Username = htmlspecialchars($data["Username"]);
    $Tlp      = htmlspecialchars($data["Tlp"]);
    $K_Pos    = htmlspecialchars($data["K_Pos"]);
    $Jln      = strtolower(htmlspecialchars($data["Jln"]));

    //cek username sudah ada atau blm
    $result = mysqli_query($conn, "SELECT Username FROM pembeli WHERE Username = '$Username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar!')
              </script>";
        return false;
    }

    //cek konfirmasi password
    if ($Pass !== $Pass2) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
              </script>";
        return false;   #agar menjalankan ELSE di Register.php
    }
    //Enkrips pass
    #Parameter => pass mana yg mau diacak & pengacake nggawe algorithm op.
    $Pass = password_hash($Pass, PASSWORD_DEFAULT);

    //jika bnr, tambahkan data ke DB Table
    #parameter kedua adalah Query.
    mysqli_query($conn, "INSERT INTO pembeli VALUES('','$Nama','$Gender','$Email',
    '$Username','$Pass','$Tlp','$K_Pos','$Jln')");
    
    return mysqli_affected_rows($conn);
}
?>
