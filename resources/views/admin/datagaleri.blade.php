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
              <div class="row">
                @foreach ($data['galeri'] as $item)
                  <div class="col-md-4">
                    <div class="card img-fluid" style="width:500px">
                      <img class="card-img-top" src="{{url('galeri/'.$item->gambar)}}" alt="Card image" style="width:100%" height ="280px">
                      <div class="card-img-overlay">
                        {{-- <h4 class="card-title">John Doe</h4>
                        <p class="card-text">Some example text some example text. Some example text some example text. Some example text some example text. Some example text some example text.</p> --}}
                        <button data-toggle="modal" data-target="#Update{{$item->id_galeri}}" class = "btn btn-light btn-sm"><i class ="fas fa-edit"></i></button>
                        <a href="" data-toggle="modal" data-target="#Delete{{$item->id_galeri}}" class="btn btn-sm btn-primary"><i class = "fas fa-trash"></i></a>
                      </div>
                    </div>
                  </div>
                  
                @endforeach

              </div>
                        
                    
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= url('insert-galeri')?>" method="post" enctype='multipart/form-data'>
            @csrf
          <div class="modal-body">
 
            <div class="form-group">
              <label for="">Gambar</label>
              <input type="file" name="gambar" id="" class="form-control" required>
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

@foreach ($data['galeri'] as $item)
<div class="modal fade" id="Update{{$item->id_galeri}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= url('update-galeri')?>" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="modal-body">
              <input type="hidden" name = "id_galeri" value = "<?= $item->id_galeri?>">
          
              <div class="form-group">
                <label for="">Gambar</label>
                <input type="file" name="gambar" id="" class="form-control">
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
<div class="modal fade" id="Delete{{$item->id_galeri}}">
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
                    <a href="{{url('delete-galeri/'.$item->id_galeri)}}" class="btn btn-success">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
