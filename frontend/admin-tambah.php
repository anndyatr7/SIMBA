<!DOCTYPE html>
<html lang="en">
<he>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Tambah Riwayat</title>
    <style>
        .card-header {
            padding: 0 !important;
        }
        .card{
            min-height: 90vh;
            background: rgba(255, 235, 244, 1);
        }

        .nav-tabs .nav-link.active {
            color: #000 !important;        
            font-weight: 700 !important;
        }

        .nav-tabs .nav-link {
            color: rgba(0, 0, 0, 0.5) !important;
            font-weight: 500;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="container mt-4 mb-4">
        <div class="card text-center mx-auto shadow rounded" style="width: 100%">
            <div class="card-header p-0">
                <ul class="nav nav-tabs w-100 d-flex justify-content-center">
                    <li class="nav-item flex-fill text-center">
                        <a style="background: white;" class="nav-link" href="admin-riwayat.php">Riwayat Pemeriksaan</a>
                    </li>
                    <li class="nav-item flex-fill text-center">
                        <a class="nav-link active" href="admin-tambah.php">Tambah Riwayat Pemeriksaan</a>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4">
                <form action="">

                    <!-- ROW 1 -->
                    <div class="row g-4">
                        <div class="col-4">
                            <label for="tb">Tinggi Badan</label>
                            <input type="text" class="form-control" placeholder="...cm" name="tb">
                        </div>
                        <div class="col-4">
                            <label for="bb">Berat Badan</label>
                            <input type="text" class="form-control" placeholder="...kg" name="bb">
                        </div>
                        <div class="col-4">
                            <label for="tenxi">Tekanan Darah</label>
                            <input type="text" class="form-control" placeholder="Tekanan Darah" name="tenxi">
                        </div>
                    </div>

                    <!-- ROW 2 -->
                    <div class="row g-4 mt-1">
                        <div class="col-4">
                            <label for="usiahamil">Usia Kehamilan</label>
                            <input type="text" class="form-control" placeholder="...minggu" name="usiahamil">
                        </div>
                        <div class="col-4">
                            <label for="fundus">Tinggi Fundus Uterus</label>
                            <input type="text" class="form-control" placeholder="...cm" name="fundus">
                        </div>
                        <div class="col-4">
                            <label for="denyut">Denyut Jantung Bayi</label>
                            <input type="text" class="form-control" placeholder="...kali/menit" name="denyut">
                        </div>
                    </div>

                    <!-- ROW 3 -->
                    <div class="row g-4 mt-1">
                        <div class="col-6">
                            <label for="keluhan">Keluhan Ibu Hamil</label>
                            <div class="dropdown">
                                <button class="btn btn-light w-100 border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Pilih Keluhan
                                </button>
                                 <ul class="dropdown-menu w-100 p-2" id="keluhanMenu">
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Mual"> Mual</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Pusing"> Pusing</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Kaki Bengkak"> Kaki Bengkak</label></li>
                                    <li><label class="dropdown-item"><input type="checkbox" class="me-2 keluhanCheck" value="Nyeri Pinggang"> Nyeri Pinggang</label></li>
                                </ul>
                            </div>
                            <input type="hidden" name="keluhan" id="keluhanInput">
                        </div>                   
                        <div class="col-3 text-start">
                           <label>Aktivitas Bayi</label>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="aktifitas" id="aktif" value="aktif">
                                <label class="form-check-label" for="aktif">Aktif</label>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="aktifitas" id="tenang" value="tenang">
                                <label class="form-check-label" for="tenang">Tenang</label>
                            </div>
                        </div>
                        <div class="col-3 text-start">
                            <label>Tablet TTD Diberikan</label>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="ttd" id="ya" value="ya">
                                <label class="form-check-label" for="ya">Ya</label>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <input class="form-check-input" style="margin-right: 10px;" type="radio" name="ttd" id="tidak" value="tidak">
                                <label class="form-check-label" for="tidak">Tidak</label>
                            </div>
                        </div>
                    </div>

                    <!-- ROW 5 -->
                    <div class="mt-4">
                        <label>Catatan Dokter</label>
                        <textarea class="form-control" name="alasan" rows="3"></textarea>
                    </div>

                    <a href="admin-riwayat.php" type="submit" class="btn btn-primary mt-5" style="width: 50%;">Tambah</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

    <script>
        document.querySelectorAll(".keluhanCheck").forEach(cb => {
            cb.addEventListener("change", () => {
                let selected = [];
                document.querySelectorAll(".keluhanCheck:checked").forEach(x => {
                    selected.push(x.value);
                });
                document.getElementById("keluhanInput").value = selected.join(",");
            });
        });
    </script>
</body>
</html>