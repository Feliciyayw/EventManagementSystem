@extends('template.master')
@section('contents')


<section class="section">
    <div class="section-header">
    <h1>{{$data['title']}}</h1>
    </div>
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
            <div class="card-header">
                <h5>Data Event</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="" class="mb-2">Image Event</label>
                            <br>
                            <a href="{{url('event/'.$data['event']->gambar_event)}}" download>
                            <center><img src="{{url('event/'.$data['event']->gambar_event)}}" width="100%"></center>
                            </a>
                        </div>
                        <br>
                        
                    </div>
                    <div class="col-md-6">
                        <h5>{{$data['event']->judul}}</h5>
                        <span>Created : {{$data['event']->created_at}} | Crew {{$data['event']->crew}} | Start : {{$data['event']->tanggal_mulai}} | Finish : {{$data['event']->tanggal_selesai}}</span>
                        <br>
                        <p><?= $data['event']->deskripsi?></p>
                        <h6>Need Crew</h6>
                        <div class="selectgroup selectgroup-pills">
                            @foreach ($data['need_crew'] as $item)
                                <label class="selectgroup-item">
                                    <input type="checkbox" name="need_crew[]" value="{{ $item->need_crew}}" class="selectgroup-input" checked = "true" readonly>
                                    <span class="selectgroup-button">{{ $item->need_crew}}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>List Join</h4>
            </div>
            <div class="card-body">
                <table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width = "5%">No.</th>
                            <th>Name Users</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Photo</th>
                            <th>Cv</th>
                            <th>Crew Position</th>
                            <th>Status Join</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($data['join_event'] as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->phone_number }}</td>
                                <td width="10%">
                                <a href="{{url('profile/'.$item->gambar)}}" download><img src="{{url('profile/'.$item->gambar)}}" alt="" width="80%"></a>    
                                </td>
                                <td><a href="{{url('cv/'.$item->cv)}}" class="badge badge-warning" download>Download</a></td>
                                <td>{{ $item->need_crew }}</td>
                                <td>{{ $item->status_join }}</td>
                        
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
</section>

@foreach ($data['detail'] as $item)
<div class="modal fade" id="Update{{$item->id_detail_event}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Status Kehadiran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= url('update-detail-event')?>" method="post" enctype='multipart/form-data'>
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" name = "id_detail_event" value = "<?= $item->id_detail_event?>">
              <input type="hidden" name = "id_event" value = "<?= $item->id_event?>">
              <input type="hidden" name = "id_users" value = "<?= $item->id_users?>">
            </div>
            <div class="form-group">
                <label for="">Status Kehadiran</label>
                <select name="status_kehadiran" class="form-control" required id="" required>
                    <option value="hadir">hadir</option>
                    <option value="tidak hadir">tidak hadir</option>
                </select>
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
@endforeach
@endsection
