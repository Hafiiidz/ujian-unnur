@extends('frame.index')
@section('title_1','active')
@section('title_2_lap','current-page')
@section('display','display: block;')
@section('style')
<style>
    input[type="checkbox"]{
    width: 25px; /*Desired width*/
    height: 25px; /*Desired height*/
    }
</style>
@endsection
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3><i class="glyphicon glyphicon-check"></i>&nbsp;<small>Filter-Soal</small></h3>
        </div>

      </div>

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Paket Soal {{ $nama_soal->nama_paket_soal }}</h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box table-responsive">
              <form action="{{ route('get.filter') }}" method="POST">
                @csrf               
              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                <input type="hidden" name="id_paket" value="{{ $id_soal }}">
                <thead>
                  <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data_mhs as $item)
                    <?php
                        $cek = DB::table('tbl_filter_kelas')
                               ->where([
                                   ['nim_mhs', $item->username],
                                   ['id_paket_soal', $id_soal]
                                   ])
                                ->get(); 
                    ?>
                    <tr>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if($cek->count() >= 1)
                            <input type="checkbox" name="pilihan[]" value="{{ $item->username }}" checked disabled="disabled">
                            &nbsp;
                            <a href="{{ route('update.status_ujian', [$item->username, $id_soal])}}" class="btn btn-warning">Cancel</a>
                            @else
                            <input type="checkbox" name="pilihan[]" value="{{ $item->username }}">
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
              </table>
            </form>        

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

  

@endsection

@section('script')
<script>
   $('#datatable').DataTable( {
        "paging":   false,
    } );



    // function updateData (id) {
    //     var get_nim = id;
    //     var get_id_soal = document.getElementById("id_paket").value;
    //     $("input:checkbox").on("change", function () {
    //     $.ajax({
	// 			type : "POST",
	// 			url:'{{route('get.filter_nim')}}',
	// 			data:{'nim_mhs':get_nim,'id_paket_soal':get_id_soal}
	// 		});
    // });
    //     // $.ajax({
	// 	// 		type : "POST",
	// 	// 		url:'{{route('get.filter_nim')}}',
	// 	// 		data:{'nim_mhs':get_nim,'id_paket_soal':get_id_soal}
	// 	// 	});
    // }
</script>
@endsection