        <!-- Begin Page Content -->
        <div class= "contianer-fluid">

        <!-- Page Heading -->
        <h1 class="h2 mb-3 text-gray-800"><?= $judul; ?></h1>

        <?php if(session()->get('message')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              Data Berhasil <strong><?= session()->getFlashdata('message'); ?></strong> 
            </div>
        <?php endif; ?>         
       
        <div class="row">
            <div class="col-md-8">
                <?php
                    if (session()->get('err')) {
                        echo "<div class='alert alert-danger p-0 pt-2' role='alert'>" . session()->get('err') ."</div>  ";
                        session()->remove('err');
                    }
                ?>
            </div>
        </div>
           

        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus"> Tambah Data </i>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class = "table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>NAMA</th>
                            <th>OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($siswa->getResultArray() as $row) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['nisn']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#modalUbah" id="btn-edit" class="btn btn-sm btn-warning" data-id="<?= $row ['id']?>" data-nisn="<?= $row ['nisn']?>" data-nama="<?= $row ['nama']?>"> <i class="fa fa-edit"></i></button>
                                <button type="button" data-toggle="modal" data-target="#modalHapus" class="btn btn-sm btn-danger"> <i class="fa fa-trash-alt"></i></button>
                            </td>
                        </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <!-- /.container-fluid -->
        </div>

        <!-- End Of Main Content -->
        </div>

<!-- Modal Ubah -->
<div class="modal fade" id="modalUbah" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah <?= $judul; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('siswa/ubah'); ?>" method="post">
                <input type="hidden" name="id" id="id-siswa">
                <div class="form-group">
                  <label for="nisn"></label>
                  <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukan NISN Anda" value="<?= $row['nisn']?>">
                </div>
                <div class="form-group">
                  <label for="nama"></label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan NAMA Anda" value="<?= $row['nama']?>">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal tambah -->
<div class="modal fade" id="modalTambah" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('siswa/tambah'); ?>" method="post">
                <div class="form-group">
                  <label for="nisn"></label>
                  <input type="text" name="nisn" id="nisn" class="form-control" placeholder="Masukan NISN Anda">
                </div>
                <div class="form-group">
                  <label for="nama"></label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan NAMA Anda">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambahkan</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah anda yakin ingin menghapus?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="/siswa/hapus/<?= $row['id']; ?>" class="btn btn-primary">Yakin</a>
            </div>
        </div>
    </div>
</div>