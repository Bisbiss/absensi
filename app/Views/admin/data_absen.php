<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Absen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() . 'admin' ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Absen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Absen</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <!-- <a href="#" class="breadcrumb-item" data-toggle="modal" data-target="#tambahguru">Tambah Siswa</a> -->
                                </div>
                            </div>
                        </div>

                        <div class="card-body overflow-auto">
                            <table class="table table-bordered table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Siswa</th>
                                        <th>L/P</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th>Waktu</th>
                                        <th>Keterangan</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $data) {
                                    ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $data->Nama_Siswa ?></td>
                                            <td><?= ($data->Jenis_Kelamin == 'PEREMPUAN' ? 'P' : 'L'); ?></td>
                                            <td><?= $data->NIS ?></td>
                                            <td><?= $data->Nama_Kelas ?></td>
                                            <td><?= $data->Waktu_Absensi ?></td>
                                            <td><?= $data->Keterangan; ?></td>
                                            <td>
                                                <?php if (isset($data->foto_siswa) && !empty($data->foto_siswa)) : ?>
                                                    <img src="<?= base_url('assets/absen/capture/' . $data->foto_siswa) ?>" class="img-fluid rotated" width="100px" style="margin-top: 10px; margin-bottom: 10px;">
                                                <?php else : ?>
                                                    <img src=" <?= base_url('assets/absen/avatar/user.png') ?>" class="img-fluid" width="100px">
                                                <?php endif; ?>
                                            </td>
                                            <td><a href="#" class="btn btn-warning btn-flat btn-xs" data-toggle="modal" data-target="<?= '#ubah' . $no ?>"><i class="fas fa-pen"></i> Ubah</a> <a href="#" class="btn btn-danger btn-flat btn-xs" data-toggle="modal" data-target="<?= '#hapus' . $no ?>"><i class="fas fa-pen"></i> Hapus</a></td>

                                        </tr>

                                        <!-- modal Ubah Absensi -->
                                        <div class="example-modal">
                                            <div id="<?= 'ubah' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title">Presensi</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/admin/ubahAbsen" method="post" role="form">
                                                                <input type="hidden" name="id_absen" value="<?= $data->ID_Absensi ?>">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-3 control-label text-right">Keterangan <span class="text-red">*</span></label>
                                                                        <div class="col-sm-8">
                                                                            <select id="Keterangan" name="Keterangan" class="form-control select2" style="width: 100%;">
                                                                                <option value="">-- Pilih Keterangan --</option>
                                                                                <option value="hadir">Hadir</option>
                                                                                <option value="sakit">Sakit</option>
                                                                                <option value="izin">Izin</option>
                                                                                <option value="alpha">Tanpa Keterangan</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                                                                    <input type="submit" name="submit" class="btn btn-success" value="Simpan">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- endModalPresensi -->

                                            <!-- Modal Hapus Absesnsi -->
                                            <div class="example-modal">
                                                <div id="<?= 'hapus' . $no ?>" class="modal fade" role="dialog" style="display:none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Konfirmasi Hapus Data Absensi</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 class="text-center">
                                                                    Apakah anda yakin ingin menghapus Absensi?
                                                                </h4>
                                                                <div class="row">
                                                                    <label class="col-sm-3 control-label text-right">Nama</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="">: <?= $data->Nama_Siswa; ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-3 control-label text-right">Tanggal</label>
                                                                    <div class="col-sm-8">
                                                                        <?php

                                                                        $tanggalAbsensi = date('d-m-Y', strtotime($data->Waktu_Absensi));
                                                                        $jamAbsensi = date('H:i', strtotime($data->Waktu_Absensi));

                                                                        ?>
                                                                        <label for="">: <?= $tanggalAbsensi; ?></label>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label class="col-sm-3 control-label text-right">Jam</label>
                                                                    <div class="col-sm-8">
                                                                        <label for="">: <?= $jamAbsensi; ?> WIB</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button id="nodelete" type="button" class="btn btn-light pull-left" data-dismiss="modal">Batal</button>
                                                                <a href="<?= '/admin/hapusAbsen/' . $data->ID_Absensi ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Hapus Absensi -->

                                        <?php
                                        $no++;
                                    }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>