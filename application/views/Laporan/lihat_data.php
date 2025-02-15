<style type="text/css">
.swal2-popup {
    font-family: inherit;
    font-size: 1.2rem;
}

.btn-group,
.btn-group-vertical {
    position: relative;
    display: initial;
    vertical-align: middle;
}
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-dark">
                <div class='box-header  with-border'>
                    <h3 class='box-title'>Data Laporan</h3>
                </div>
                <!-- <div class="row">
                    <div class="col-xs-12">
                        <?php echo form_open('laporan', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                        <div class="col-md-3">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="start_date" class="control-label">Tanggal Awal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="start_date" id="start_date"
                                            data-error="Tanggal Awal harus diisi" required />
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="end_date" class="control-label">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="end_date" id="end_date"
                                            data-error="Tanggal Akhir harus diisi" required />
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="metode" class="control-label">Metode</label>
                                <div class="input-group">
                                    <select class="form-control" name="metode">
                                        <option value="">Pilih Semua</option>
                                        <?php
                                        foreach ($metode as $m) {
                                            echo "<option value=' $m->id_byr'>$m->metode</option>";
                                        }
                                        ?>
                                    </select>
                                    <span class="input-group-addon">
                                        <span class="fa fa-list"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="submit" name="search" id="search" value="Search" class="btn btn-info">
                                Search</button>
                        </div>
                        </form>
                    </div>
                </div> -->
                <div class="box-body">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jam Transaksi</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Transaksi</th>
                                <?php if ($this->session->userdata('akses') == 1) { ?>
                                <th style="text-align: center">&emsp; Action</th>
                                <?php } else if ($this->session->userdata('akses') == 2) { ?>
                                <th style="text-align: center">&emsp; Action</th>
                                <?php } else { ?>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($laporan as $row) {
                                $no_trf = $row->no_trf;
                            ?>
                            <tr>
                                <td><?php echo ++$no; ?></td>
                                <td><?php echo $row->no_trf; ?></td>
                                <td><?php echo $row->nama_pelanggan; ?></td>
                                <td><?php echo $row->tgl_trf; ?></td>
                                <td><?php echo $row->jam_trf; ?></td>
                                <td><?php echo $row->metode; ?></td>
                                <td><?php echo $row->status_transaksi; ?></td>
                                <td>
                                    <div id="laporan_<?php echo $row->id; ?>"></div>
                                </td>
                                <?php if ($this->session->userdata('akses') == 1) { ?>
                                <td style="text-align: center">
                                    <?php echo anchor(site_url('laporan/status/' . $no_trf), '<i class="fa fa-eye"></i>&nbsp;&nbsp;Update', array('title' => 'Update', 'class' => 'btn btn-sm btn-warning'));
                                            echo '&nbsp';
                                            echo anchor(site_url('laporan/struk/' . $row->id), '<i class="fa fa-eye"></i>&nbsp;&nbsp;Struk', array('title' => 'Struk', 'class' => 'btn btn-sm btn-info'));
                                            echo '&nbsp';
                                            echo anchor(site_url('laporan/hapus/' . $row->id), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
                                            ?>
                                </td>
                                <?php } else if ($this->session->userdata('akses') == 2) { ?>
                                <td style="text-align: center">
                                    <?php echo anchor(site_url('laporan/status/' . $no_trf), '<i class="fa fa-eye"></i>&nbsp;&nbsp;Update', array('title' => 'Update', 'class' => 'btn btn-sm btn-warning'));
                                            echo '&nbsp';
                                            echo anchor(site_url('laporan/hapus/' . $row->id), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
                                            ?>
                                </td>
                                <?php } else { ?>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    <?php foreach ($laporan as $row) : ?>
    var laporan_<?php echo $row->id; ?> = "<?php echo $row->catatan; ?>";
    var jumlahKata = 3; // Ganti dengan jumlah kata yang Anda inginkan

    // Fungsi untuk memotong laporan menjadi beberapa kata saja
    function potongLaporan(laporan, jumlahKata) {
        var kata = laporan.split(' ').slice(0, jumlahKata).join(' ');
        if (laporan.split(' ').length > jumlahKata) {
            kata += ' ...';
        }
        return kata;
    }

    // Menampilkan laporan yang sudah dipotong di dalam elemen <div> yang sesuai
    var laporanTerpotong = potongLaporan(laporan_<?php echo $row->id; ?>, jumlahKata);
    document.getElementById('laporan_<?php echo $row->id; ?>').textContent = laporanTerpotong;
    <?php endforeach; ?>
});

$(document).ready(function() {
    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#myTable').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
            {
                extend: 'excelHtml5',
                title: 'LAPORAN PENJUALAN',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
            {
                extend: 'copyHtml5',
                title: 'LAPORAN PENJUALAN',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
            {
                extend: 'pdfHtml5',
                oriented: 'portrait',
                pageSize: 'legal',
                title: 'LAPORAN PENJUALAN',
                download: 'open',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
                customize: function(doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1)
                        .join('*').split('');
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                },
            },
            {
                extend: 'print',
                oriented: 'portrait',
                pageSize: 'A4',
                title: 'LAPORAN PENJUALAN',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
                },
            },
        ],
    });
});
</script>