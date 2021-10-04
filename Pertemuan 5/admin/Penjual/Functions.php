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

//Fungsi insert data dan $data merupakan variabel ngge nyimpen hasile
function tambahData($data){
   global $conn;
    
    #user td dpt menulis slash & membuat inputan user dengan huruf biasa/tdk kapital
    $Nama_Pemilik = strtolower(htmlspecialchars($data["Nama_Pemilik"]));
    $Nama_Toko    = strtolower(htmlspecialchars($data["Nama_Toko"]));
    $Email        = htmlspecialchars($data["Email"]);
    $Username     = stripcslashes($data["Username"]);

    #user dpt menulis seluruh jenis karakter
    $Pass         = mysqli_real_escape_string ($conn,$data["Pass"]);
    $Pass2        = mysqli_real_escape_string ($conn,$data["Pass2"]);

    #bn ra dihack/dileboni angger code
    $Tlp          = htmlspecialchars($data["Tlp"]);
    $K_Pos        = htmlspecialchars($data["K_Pos"]);
    $Jln          = strtolower(htmlspecialchars($data["Jln"]));

    //Untuk input gambar
    $Gambar       = $_FILES['Gambar']['name'];
    $source       = $_FILES['Gambar']['tmp_name'];
    $folder       = "./img".$Gambar;
    move_uploaded_file($source, $folder);

    //cek username sudah ada atau blm
    $result = mysqli_query($conn, "SELECT Username FROM penjual WHERE Username = '$Username'");
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
    mysqli_query($conn, "INSERT INTO penjual VALUES('','$Nama_Pemilik','$Nama_Toko','$Email','$Username','$Pass','$Tlp','$K_Pos','$Jln','$Gambar')");
    
    return mysqli_affected_rows($conn);
}

//Fungsi hapus data t
function hapusData($id_Penjual){
    global $conn;
    mysqli_query($conn, "DELETE FROM penjual WHERE id_Penjual = $id_Penjual");
    return mysqli_affected_rows($conn);
}

//Fungsi edit data 
function editData($data){
    global $conn;
    
    //Ambil data di tiap Form
    #htmlspecialchars agar tidak bisa dihack/dimasukkin sembarang karakter tidak ngaruh
    $id_Penjual   = $data["id_Penjual"];
    $Nama_Pemilik     = htmlspecialchars($data["Nama_Pemilik"]);
    $Nama_Toko     = htmlspecialchars($data["Nama_Toko"]);
    $Email    = htmlspecialchars($data["Email"]);
    $Username = htmlspecialchars($data["Username"]);
    $Pass     = htmlspecialchars($data["Pass"]);
    $Tlp      = htmlspecialchars($data["Tlp"]);
    $K_Pos    = htmlspecialchars($data["K_Pos"]);
    $Jln      = htmlspecialchars($data["Jln"]);
    // $Gambar      = $_FILES["Gambar"];

    #Query insert data
    $query = "UPDATE penjual SET
              Nama_Pemilik = '$Nama_Pemilik',
              Nama_Toko = '$Nama_Toko',
              Email = '$Email',
              Username = '$Username',
              Pass = '$Pass',
              Tlp = '$Tlp',
              K_Pos = '$K_Pos',
              Jln = '$Jln'

              WHERE id_Penjual = $id_Penjual";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cariData($keyword){
    #LIKE untuk mencari kata yg mirip. % untuk blank txt
    $query = "SELECT * FROM penjual WHERE
    Nama_Pemilik LIKE '%$keyword%' OR Nama_Toko LIKE '%$keyword%' OR 
    Email LIKE '%$keyword%' OR Username LIKE '%$keyword%' OR 
    Tlp LIKE '%$keyword%' OR K_Pos LIKE '%$keyword%'OR 
    Jln LIKE '%$keyword%'";
    return query($query);
}
?>