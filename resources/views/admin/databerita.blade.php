@extends('template.master')
@section('contents')


<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Create Data
    </button>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                @if (session()->has('err_message'))
                    <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                        <strong>Error! </strong>{{ session()->get('err_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('suc_message'))
                    <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                        <strong>Success! </strong>{{ session()->get('suc_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead >
                        <tr >
                            <th width = "5%">No.</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Penulis</th>
                            <th>Created</th> 
                            <th>Gambar</th> 
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['informasi'] as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->judul}}</td>
                                <td><?= $item->deskripsi?></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td width="15%"><img src="{{url('berita/'.$item->gambar_informasi)}}" alt="" width="100%"></td>
                            
                                <td width = "10%" class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id_informasi}}">
                                        <i class="fa fa-edit"></i> 
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$item->id_informasi}}">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= url('insert-berita')?>" method="post" enctype='multipart/form-data'>
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="">judul</label>
              <input type="text" name="judul" id="" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea name="deskripsi" id="" cols="30" rows="10" class = "form-control summernote" required></textarea>
            </div>
            <div class="form-group">
              <label for="">Gambar</label>
              <input type="file" name="gambar_informasi" id="" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name = "insert" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@foreach ($data['informasi'] as $item)
<div class="modal fade" id="Update{{$item->id_informasi}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= url('update-berita')?>" method="post" enctype='multipart/form-data'>
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="">judul</label>
              <input type="hidden" name = "id_informasi" value = "<?= $item->id_informasi?>">
              <input type="text" name="judul" id="" class="form-control" required value = "{{$item->judul}}">
            </div>
            <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea name="deskripsi" id="" cols="30" rows="10" class = "form-control summernote" required value = "<?= $item->deskripsi?>"><?= $item->deskripsi?></textarea>
            </div>
            <div class="form-group">
              <label for="">Gambar</label>
              <input type="file" name="gambar_informasi" id="" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name = "insert" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Delete{{$item->id_informasi}}">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
                <div class="modal-body">
                   <p>Apakah Anda Yakin untuk Mennghapus</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{url('delete-berita/'.$item->id_informasi)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
