<html>
    <head>
        <title>Agent Form</title>
    </head>
    <center>
        <h2> FORMULIR PENDAFTARAN <br> INTERFLOW PROPERTY CONSULTANT</h2>
    </center> <br> 

    <table class="table_form">
        <tr> 
            <td> Tanggal Permohonan (Tgl - Bln - Thn) </td>
            <td width="435px"> : <?php echo isset($data->tgl_permohonan) ?  date('d-m-Y', strtotime($data->tgl_permohonan)) : '';  ?> </td>
        </tr>

        <tr> 
            <td> Nomor ID </td>
            <td> : <?php echo isset($data->id_user) ? $data->id_user : '';  ?> </td>
        </tr>

        <tr> 
            <td> Nama Lengkap (Sesuai dengan KTP) </td>
            <td> : <?php echo isset($data->fullname) ? $data->fullname : '';  ?> </td>
        </tr>

        <tr> 
            <td> Tempat, Tanggal Lahir </td>
            <td> : <?php echo isset($data->tempat_lahir) ? ucfirst($data->tempat_lahir) : '';  ?> <?php echo isset($data->tgl_lahir) ? ', '.date('d-m-Y', strtotime($data->tgl_lahir)) : '';  ?>  </td>
        </tr>

        <tr> 
            <td> Jenis Identitas </td>
            <td> : <?php echo isset($data->jns_identitas) ? $data->jns_identitas : '';  ?>
                <!-- <input type="checkbox" name="jns_identitas" value="1" checked> KTP &nbsp; &nbsp;
                <input type="checkbox" name="jns_identitas" value="1" checked> SIM -->
            </td>
        </tr>

        <tr> 
            <td> Nomor Identitas </td>
            <td> : <?php echo isset($data->nmr_identitas) ? $data->nmr_identitas : '';  ?> </td>
        </tr>

        <tr> 
            <td> Jenis Kelamin </td>
            <td> : <?php echo isset($data->gender) ? $data->gender : '';  ?>
                <!-- <input type="checkbox" name="jns_kelamin" value="1" checked> Pria &nbsp; &nbsp;
                <input type="checkbox" name="jns_kelamin" value="1"> Wanita -->
            </td>
        </tr>

        <tr> 
            <td> Alamat Tempat Tinggal (saat ini) </td>
            <td> : <?php echo isset($data->alamat) ? $data->alamat : '';  ?>  </td>
        </tr>

        <tr> 
            <td> Kode Area & Nomor Telepon (Rumah) </td>
            <td> : <?php echo isset($data->kode_area_telp) ? $data->kode_area_telp : '';  ?> <?php echo isset($data->telp_rumah) ? $data->telp_rumah : '';  ?></td>
        </tr>

        <tr> 
            <td> Nomor Telepon Seluler </td>
            <td> : 1. <?php echo isset($data->phone) ? $data->phone : '';  ?> </td>
        </tr>

        <tr> 
            <td></td>
            <td> : 2. <?php echo isset($data->phone2) ? $data->phone2 : '';  ?> </td>
        </tr>

        <tr> 
            <td> Alamat Email </td>
            <td> : <?php echo isset($data->email) ? $data->email : '';  ?>  </td>
        </tr>

        <tr> 
            <td> Pendidikan Terakhir </td>
            <td> : <?php echo isset($data->last_education) ? $data->last_education : '';  ?> 
                <!-- <input type="checkbox" name="last_education" value="1" checked> SMA 
                <input type="checkbox" name="last_education" value="1"> S1 
                <input type="checkbox" name="last_education" value="1"> S2 
                <input type="checkbox" name="last_education" value="1"> S2 
                <input type="checkbox" name="last_education" value="1"> S3 
                <input type="checkbox" name="last_education" value="1"> Lainnya -->
            </td>
        </tr>

        <tr> 
            <td> Status </td>
            <td> : <?php echo isset($data->mar_stat) ? $data->mar_stat : '';  ?> 
                <!-- <input type="checkbox" name="marital_status" value="1"> Menikah &nbsp; &nbsp; &nbsp; 
                <input type="checkbox" name="marital_status" value="1" checked> Belum Menikah -->
            </td>
        </tr>

        <tr> 
            <td> Agama </td>
            <td> : <?php echo isset($data->agama) && ($data->agama != 0) ? $data->agama : '';  ?> </td>
        </tr>

        <tr> 
            <td> Rekening Bank BCA No. Rekening </td>
            <td> : <?php echo isset($data->no_rek) ? $data->no_rek : '';  ?> </td>
        </tr>

        <tr> 
            <td> KCP & Atas Nama </td>
            <td> : <?php echo isset($data->kcp  ) ? $data->kcp     : '';  ?> <?php echo isset($data->no_rek_atasnama) && !empty($data->no_rek_atasnama) ? 'a.n. '.$data->no_rek_atasnama : '';  ?></td>
        </tr>

        <tr> 
            <td> Kelengkapan </td>
            <td> : </td>
        </tr>

        <tr>
            <td colspan="2"> 
                <?php 
                        echo isset($data->kelengkapan) ? $data->kelengkapan : '';

                        /* $arr_doc = explode(" | ", $data->kelengkapan);
                        echo isset($arr_doc[0]) ? $arr_doc[0].' ' : '';  
                        echo isset($arr_doc[1]) ? $arr_doc[1].' ' : '';  
                        echo isset($arr_doc[2]) ? $arr_doc[2].' ' : '';  
                        echo isset($arr_doc[3]) ? $arr_doc[3].' ' : '';   */
                ?>

                <!-- <input type="checkbox" name="fc_dokumen" value="FC KTP" checked> FC KTP
                <input type="checkbox" name="fc_dokumen" value="FC NPWP" > FC NPWP
                <input type="checkbox" name="fc_dokumen" value="FC KK, KTP SUAMI"> FC KK, KTP SUAMI
                <input type="checkbox" name="fc_dokumen" value="FC COVER BUKU TABUNGAN" checked> FC COVER BUKU TABUNGAN    -->
            </td>
        </tr>

        <tr>
            <td colspan="2"> <b><u> REFERENSI </u></b>  </td>
        </tr>

        <tr>
            <td> Nomor ID : <?php echo isset($data->id_ref_agent) && ($data->id_ref_agent != 0) ? $data->id_ref_agent : '';  ?> </td>
            <!-- <td> : </td> -->
            <td> Nama Lengkap : <?php echo isset($data->nama_referensi) ? $data->nama_referensi : '';  ?> </td>
            <!-- <td> : </td> -->
        </tr>
    </table>
    
</html>

<style>

    table.table_form {
        border-collapse:separate; 
        border-spacing:0 10px; 
    }

    /* td {
        border: 1px solid black;
        border-style: dotted;
    } */

    input[type='checkbox'] {
        transform: scale(1.5);
        padding-left: 5px;
        padding-right: 5px;
        padding-top: 5px;
        padding-bottom: -5px;
    }

</style>