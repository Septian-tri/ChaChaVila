<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('../home.php'); ?>
    <!-- format buat nambahin page / halaman baru -->
    <div class="page-wrapper new-theme toggled">
        <main class="page-content">
            <div class="container-fluid">
                <h2>Tambahkan Villa Baru Di bawah</h2>
                <hr>
                <div class="row">
                    <div class="form-group col-md-12">
                        <p>Silahkan masukan vila baru di bawah, jika tidak terdapat fasilitas villa bisa di kosongkan saja dan masksimal upload size gambar 1 mb</p>
                    </div>
                </div>

                <input type="text" class="FV" maxlength="100" id="NamaVilla" placeholder="Nama Villa"><br />
                <input type="text" class="FV" maxlength="300" id="AlamatVilla" placeholder="Lokasi / Alamat Villa"><br />
                <input type="text" class="FV" maxlength="20" id="HargaVilla" placeholder="HargaVilla / Malam"></br />
                <label for="ThumbnailVilla">Thumbnail / Gambar depan Villa</label>
                <input type="file" class="FV" accept="image/*" id="ThumbnailVilla">

                <h5>Fasilitas Villa Yang tersedia</h5>

                <label for="FVT_RuangTamu">Ruang Tamu</label>
                <input type="text" class="FV" maxlength="2" id="FVT_RuangTamu" placeholder="Total Ruang Tamu">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_RuangTamu_IMG">
                <br />

                <label for="FVT_KamarTidur">Kamar Tidur</label>
                <input type="text" class="FV" maxlength="2" id="FVT_KamarTidur" placeholder="Total Kamar Tidur">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_KamarTidur_IMG">
                <br />

                <label for="FVT_RuangKeluarga">Ruang Keluarga</label>
                <input type="text" class="FV" maxlength="2" id="FVT_RuangKeluarga" placeholder="Total Ruang Keluarga">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_RuangKeluarga_IMG">
                <br />

                <label for="FVT_KamarMandi">Kamar Mandi</label>
                <input type="text" class="FV" maxlength="2" id="FVT_KamarMandi" placeholder="Kamar Mandi">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_KamarMandi_IMG">
                <br />

                <label for="FVT_Mushola">Mushola</label>
                <input type="text" name="fasilitasVilla" class="FV" maxlength="2" id="FVT_Mushola">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_Mushola_IMG">
                <br />

                <label for="FVT_Dapur">Dapur</label>
                <input type="text" name="fasilitasVilla" class="FV" maxlength="2" id="FVT_Dapur">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_Dapur_IMG">
                <br />

                <label for="FVT_RuangKerja">Ruang Kerja</label>
                <input type="text" name="fasilitasVilla" class="FV" maxlength="2" id="FVT_RuangKerja">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_RuangKerja_IMG">
                <br />

                <label for="FVT_Garasi">Garasi</label>
                <input type="text" name="fasilitasVilla" class="FV" maxlength="2" id="FVT_Garasi">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_Garasi_IMG">
                <br />

                <label for="FVT_Garasi">Area Parkir</label>
                <input type="text" name="fasilitasVilla" class="FV" maxlength="2" id="FVT_AreaParkir">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_AreaParkir_IMG">
                <br />

                <label for="FVT_Taman">Taman</label>
                <input type="text" name="fasilitasVilla" class="FV" maxlength="2" id="FVT_Taman">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_Taman_IMG">
                <br />

                <label for="FVT_KolamRenang">Kolam Renang</label>
                <input type="text" name="fasilitasVilla" class="FV" maxlength="2" id="FVT_KolamRenang">
                <input type="file" accept="image/*" class="FV" maxlength="2" id="FVT_KolamRenang_IMG">
                <br />

                <label for="FVT_Televisi">Televisi</label>
                <input type="checkbox" name="fasilitasVilla" class="FV" id="FVT_Televisi">
                <br />

                <label for="FVT_Wifi">Wifi</label>
                <input type="checkbox" name="fasilitasVilla" class="FV" id="FVT_Wifi">
                <br />
                <div>
                    <script type="text/javascript">
                        tinymce.init({
                            selector: '#deskripsi'
                        });
                    </script>
                    <b>Deskripsi Villa</b>
                    <textarea name="deskripsiVila" id="deskripsi"></textarea>
                    
                    <button type="button" class="btn btn-success" id="advBtn">Tambahkan Villa</button>
                </div>
            </div>
        </main> 
    </div>
    <script src="../../Settings/js/dashboardAdmin.js"></script>
</body>
</html>