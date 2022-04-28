<!-- Sub banner start -->
<div class="sub-banner text-center">
    <div class="page-title">
        <h1><?= isset($title_2) ? $title_2:'';?></h1>
    </div>
</div>
<!-- Sub Banner end -->
<section id="breadcrumb">
    <div class="container breadcrumb-area">
        <div class="breadcrumb-areas">
            <ul class="breadcrumbs">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li class="active"><?= isset($title) ? $title:'';?></li>
            </ul>
        </div>
    </div>
</section>

<!-- Our team start -->
<div class="photo-gallery content-area-13">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?= isset($data_karir) ? $data_karir:'';?>
                <br>
                <?= isset($data_page) ? $data_page:'';?>
            </div>
            <div class="col-md-4">
                <div class="form-lamaran">
                    <div class="text-center" style="margin-top: 2%;">
                        <h5 class="bold" style="color: #F08519;">KIRIM LAMARAN ANDA</h5>
                    </div>
                    <form id="form_data" class="form-horizontal" method="POST">
                        <div id="msg_alert"></div>
                        <div class="on-top-5">
                            <label class="small">Nama lengkap*</label>
                            <div>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                            </div>
                        </div>
                        <div class="on-top-5">
                            <label class="small">Email*</label>
                            <div>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="on-top-5">
                            <label class="small">No. Telepon*</label>
                            <div>
                                <input type="text" class="form-control" name="notelp" id="notelp">
                            </div>
                        </div>
                        <div class="on-top-5">
                            <label class="small">Alamat*</label>
                            <div>
                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="on-top-5">
                            <label class="small">Jenis Kelamin*</label>
                            <div>
                                <label>
                                    <input type="radio" name="jenis_kelamin" id="jenis_kelaminl" value="L" checked>
                                    Laki-laki
                                </label>
                                &nbsp;
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="P" id="jenis_kelaminp">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div class="on-top-5">
                            <label class="small">Tempat Tanggal Lahir*</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control date-picker" name="tanggal_lahir" id="tanggal_lahir" placeholder="dd/mm/yyyy" data-date-format="dd/mm/yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="on-top-5">
                            <label class="small">Upload CV* <sup>Format PDF, Maks file 2 MB</sup></label>
                            <div>
                                <input type="file" name="file_pdf" id="file_pdf" class="form-control">
                            </div>
                        </div>
                        <div class="on-top-5">
                            <label class="small">Posisi yang akan di isi*</label>
                            <div>
                                <?= form_dropdown('posisi_kerja', $opt_posisi, '', 'class="form-control" id="posisi_kerja"');?>
                            </div>
                        </div>
                        <br>
                        <div class="on-top-5">
                            <div id="captcha_el" class="g-recaptcha" data-sitekey="6Lfz1LcUAAAAAPIx6KW33lR1vMpFlT_826O6NLFO"></div>
                        </div>
                        <br>
                        <div class="on-top-5">
                            <label>Email : interflow.property@gmail.com</label>
                        </div>
                        <br>
                        <div class="on-top-5">
                            <button type="button" id="btn-simpan" class="btn btn-primary btn-block" onclick="kirim()">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our team end -->