<?php
//KONEKSI MySQL & Kita butuh parameter di dlm FUNC ini
$conn = mysqli_connect("localhost","root","","warcaf");

function query($query){
    global $conn;   #Mengecek apakah ada var ini di file ini?
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
    $Username     = stripcslashes($data["Username"]);
    $Name     = strtolower(stripcslashes($data["Name"]));

    #user dpt menulis seluruh jenis karakter
    $Pass         = mysqli_real_escape_string ($conn,$data["Pass"]);
    $Pass2        = mysqli_real_escape_string ($conn,$data["Pass2"]);

    //cek username sudah ada atau blm
    $result = mysqli_query($conn, "SELECT Username FROM admin WHERE Username = '$Username'");
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
    mysqli_query($conn, "INSERT INTO admin VALUES('','$Name','$Username','$Pass')");
    
    return mysqli_affected_rows($conn);
}
?>