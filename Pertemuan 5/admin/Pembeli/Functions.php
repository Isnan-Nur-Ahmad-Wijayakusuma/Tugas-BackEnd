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

//Fungsi hapus data tabel pembeli
function hapusData($id_Pembeli){
    global $conn;
    mysqli_query($conn, "DELETE FROM pembeli WHERE id_Pembeli = $id_Pembeli");
    return mysqli_affected_rows($conn);
}

//Fungsi edit data 
function editData($data){
    global $conn;
    
    //Ambil data di tiap Form
    #htmlspecialchars agar tidak bisa dihack/dimasukkin sembarang karakter tidak ngaruh
    $id_Pembeli   = $data["id_Pembeli"];
    $Nama     = htmlspecialchars($data["Nama"]);
    $Gender   = htmlspecialchars($data["Gender"]);
    $Email    = htmlspecialchars($data["Email"]);
    $Username = htmlspecialchars($data["Username"]);
    $Pass     = htmlspecialchars($data["Pass"]);
    $Tlp      = htmlspecialchars($data["Tlp"]);
    $K_Pos    = htmlspecialchars($data["K_Pos"]);
    $Jln      = htmlspecialchars($data["Jln"]);

    #Query insert data
    $query = "UPDATE pembeli SET
              Nama = '$Nama',
              Gender = '$Gender',
              Email = '$Email',
              Username = '$Username',
              Pass = '$Pass',
              Tlp = '$Tlp',
              K_Pos = '$K_Pos',
              Jln = '$Jln'

              WHERE id_Pembeli = $id_Pembeli";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cariData($keyword){
    #LIKE untuk mencari kata yg mirip. % untuk blank txt
    $query = "SELECT * FROM pembeli WHERE
    Nama LIKE '%$keyword%' OR Email LIKE '%$keyword%' OR 
    Username LIKE '%$keyword%' OR Tlp LIKE '%$keyword%' OR 
    K_Pos LIKE '%$keyword%'OR Jln LIKE '%$keyword%'";
    return query($query);
}
//Fungsi insert data dan $data merupakan variabel untuk nyimpan hasilnya
function tambahData($data){
    global $conn;
    
    #user tdk dpt menulis slash & membuat inputan user dengan huruf biasa/tdk kapital
    $Nama     = strtolower(htmlspecialchars($data["Nama"]));
    $Gender   = strtoupper(stripcslashes($data["Gender"]));
    $Email    = htmlspecialchars($data["Email"]);
    $Username = strtolower(stripcslashes($data["Username"]));

    #user dpt menulis seluruh jenis karakter
    $Pass  = mysqli_real_escape_string ($conn,$data["Pass"]);
    $Pass2 = mysqli_real_escape_string ($conn,$data["Pass2"]);

    #Agar tidak bisa dihack/dimasukkin sembarang karakter tidak ngaruh
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
    #Parameter => pass mana yg mau diacak & pengacaknya menggunakan algorithm apa.
    $Pass = password_hash($Pass, PASSWORD_DEFAULT);

    //jika bnr, tambahkan data ke DB Table
    #parameter kedua adalah Query.
    mysqli_query($conn, "INSERT INTO pembeli VALUES('','$Nama','$Gender','$Email','$Username','$Pass','$Tlp','$K_Pos','$Jln')");
    
    return mysqli_affected_rows($conn);
}
?>