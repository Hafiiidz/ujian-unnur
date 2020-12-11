@extends('frame.index')
@section('title_1_user','active')
@section('display','display: block;')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3><i class="glyphicon glyphicon-check"></i>&nbsp;<small>List User</small></h3>
        </div>

      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Kategori Soal</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSimpan">+ Tambah Data</button>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>NIM / NIDN</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                @foreach ($data_user as $item)
                  <tr>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        @if($item->id_prodi == "55201")
                        Ilmu Komputer Dan Informatika
                        @else
                        NULL
                        @endif
                    </td>
                    <td>{{ $item->status }}</td>
                    <td>

                        <button id="btnUbah" data-toggle="modal" data-target="#modalUbah" onclick="tampilData('{{ $item->id }}');" class="btn btn-success btn-sm">Ubah</button>
                        <a href="{{ route('hapus.user',$item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('apakah data ini akan di hapus?, {{ $item->name }}')">Hapus</a>
                    </td>
                  </tr>              
                @endforeach
                </tbody>
              </table>
            </div>
            </div>
        </div>
      </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  <!-- /page content -->

  <!-- Modal -->
    <div class="modal fade" id="modalSimpan" tabindex="-1" role="dialog" aria-labelledby="modalSimpanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalSimpanLabel">Tambah Data User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('simpan.user') }}" method="POST">  
                @csrf
                    <div class="form-group">
                        <label for="">NIM / NIDN</label>
                        <input type="text" id="username" name="username" class="form-control"  placeholder="ex: 552012324" required >
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control"  placeholder="ex: Budi Abdul" required >
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" id="email" name="email" class="form-control"  placeholder="ex: Budi@example.com" required >
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" id="password" name="password" class="form-control"   required >
                    </div>
                    <div class="form-group">
                        <label for="">Prodi</label>
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="" selected disabled>-Pilih Prodi-</option>
                            <option value="55201">Ilmu Komputer Dan Informatika</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="" selected disabled>-Pilih Status-</option>
                            <option value="dosen">Dosen</option>
                            <option value="mhs">Mahasiswa</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
        </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Ubah-->
    <div class="modal fade" id="modalUbah" tabindex="-1" role="dialog" aria-labelledby="modalUbahLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalUbahLabel">Ubah Data Kategori Soal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ubah.user') }}" method="POST">  
                    @csrf
                <div class="form-group">
                    <label for="">NIM / NIDN</label>
                    <input type="text" class="form-control" id="username_ubah" name="username" placeholder="ex: 525252552" readonly required>
                    <input type="hidden" class="form-control" id="id_ubah" name="id" value="">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" id="name_ubah" name="name" class="form-control"  placeholder="ex: Budi Abdul" required >
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" id="email_ubah" name="email" class="form-control"  placeholder="ex: Budi@example.com" required >
                </div>
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="text" id="password_ubah" name="password" class="form-control" placeholder="*Kosongkan jika tidak di ubah">
                </div>
                <div class="form-group">
                    <label for="">Prodi</label>
                    <select name="prodi" id="prodi_ubah" class="form-control">
                        <option value="" selected disabled>-Pilih Prodi-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="status_ubah" class="form-control">
                        <option value="" selected disabled>-Pilih Status-</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-success">Ubah</button>
            </div>
                </form>
        </div>
        </div>
    </div>
    <!-- End Modal -->

@endsection

@section('script')
<script>
    function tampilData (id) {
        var get_id = id;

        $.ajax({
				type : "GET",
				url:'{{route('get.user')}}',
				data:{'id':get_id},
				success:function(data){
                    console.log(data.id);
                    $("#id_ubah").val(data.id);
                    $("#username_ubah").val(data.username);
                    $("#name_ubah").val(data.name);
                    $("#email_ubah").val(data.email);

                    if(data.id_prodi == "55201"){
                        $("#prodi_ubah").append('<option value="'+ data.id_prodi +'"selected>Ilmu Komputer Dan Informatika</option>');
                    }else{
                        $("#prodi_ubah").append('<option value="55201"selected>Ilmu Komputer Dan Informatika</option>');
                    }
                   
                    if(data.status == 'dosen'){
                        $("#status_ubah").append('<option value="'+ data.status +'"selected>Dosen</option>');
                        $("#status_ubah").append('<option value="mhs">Mahasiswa</option>');
                    }else if(data.status == 'mhs'){
                        $("#status_ubah").append('<option value="dosen">Dosen</option>');
                        $("#status_ubah").append('<option value="'+ data.status +'"selected>Mahasiswa</option>');
                    }else{
                        $("#status_ubah").append('<option value="dosen">Dosen</option>');
                        $("#status_ubah").append('<option value="mhs">Mahasiswa</option>');
                    }
				}
			});
    }
</script>
@endsection