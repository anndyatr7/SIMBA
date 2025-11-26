<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .kotak{
            width: 700px;
            min-height: 500px;
            background: rgb(244, 241, 245);
        }
    </style>
    <link rel="stylesheet" href="styling/buatindex.css?v<?php echo time();?>" >

</head>
<body>
    

    <div class="d-flex justify-content-center" style="padding: 40px;">
        <div class="kotak" style="padding: 30px 45px 45px 45px;">
            <div style="text-align: center;">
                <h2>Formulir Pendaftaran Akun</h2>
                <hr />
            </div>
            <form action="../backend/create-user.php" id="form" class="need-validation" method="POST" novalidate>
                <div action="" class="d-flex gap-4">
                    <div class="form-group w-50">
                        <label for="exampleInputName1">Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan Nama Anda" class="form-control" name="nama">
                    </div>
                    <div class="form-group w-50">
                        <label for="nik">NIK</label>
                        <input type="text" placeholder="Masukkan NIK Anda" class="form-control" name="nik" required>
                    </div>
                </div>
                
                <div action="" class="d-flex gap-4 mt-3">
                    <div class="form-group w-50">
                        <label for="exampleInputEmail1">Alamat Email</label>
                        <input type="email" placeholder="contoh@email.com" class="form-control" name="email">
                    </div>
                    <div class="form-group w-50">
                        <label for="exampleInputEmail1">Password Akun</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                
                <div action="" class="d-flex gap-4 mt-3">
                    <div class="form-group w-40">
                        <label for="nohp">Nomor HP</label>
                        <input type="number" placeholder="08XXXXXXXX" class="form-control" name="no_hp">
                    </div>
                    <div class="form-group w-30">
                        <label for="goldar">Golongan Darah</label>
                        <div class="dropdown">
                            <button class="btn btn-light w-100 border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Pilih Golongan Darah
                            </button>
                             <ul class="dropdown-menu w-100 p-2" id="goldar">
                                <li><label class="dropdown-item"><input type="checkbox" class="me-2 goldarCheck" value="A"> A</label></li>
                                <li><label class="dropdown-item"><input type="checkbox" class="me-2 goldarCheck" value="B"> B</label></li>
                                <li><label class="dropdown-item"><input type="checkbox" class="me-2 goldarCheck" value="AB"> AB</label></li>
                                <li><label class="dropdown-item"><input type="checkbox" class="me-2 goldarCheck" value="O"> O</label></li>
                            </ul>
                        </div>
                        <input type="hidden" name="goldar" id="goldar">
                    </div> 
                    <div class="form-group w-30 text-start">
                        <label>Gender</label>
                         <div class="d-flex align-items-center mb-2">
                             <input class="form-check-input" style="margin-right: 10px;" type="radio" name="gender" id="Perempuan" value="1">
                             <label class="form-check-label" for="Perempuan">Perempuan</label>
                         </div>
                         <div class="d-flex align-items-center mb-2">
                             <input class="form-check-input" style="margin-right: 10px;" type="radio" name="gender" id="Laki-laki" value="2">
                             <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                         </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-5">
                        <div class="mb-3">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" placeholder="Kota Kelahiran" name="tempat_lahir" id="tempat_lahir">
                        </div>
                        <div>
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                        </div>
                    </div>
                    
                    <div class="col-7">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="5" placeholder="Masukkan alamat lengkap"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-3">
                    <button type="submit" class="btn btn-primary mt-3" id="buttonkirim" style="width: 75%;" name="regis">Daftar Sekarang</button>
                    <button type="reset" class="btn btn-danger mt-3" style="width: 25%;">Reset</button>
                </div>
                
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>