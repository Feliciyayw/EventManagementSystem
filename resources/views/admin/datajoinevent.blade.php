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
            <div class="card-body">
                <table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th width = "5%">No.</th>
                            <th>Name Users</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Cv</th>
                            <th>Name Event</th>
                            <th>Status Join</th>
                            <th>Date Event</th>
                            <th>Crew</th>
                            <th>Crew Position</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($data['join_event'] as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td width="10%"><img src="{{url('profile/'.$item->gambar)}}" alt="" width="80%"></td>
                                <td><a href="{{url('cv/'.$item->cv)}}" class="badge badge-warning" download>Download</a></td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->status_join }}</td>
                                <td>{{ $item->tanggal_mulai }}</td>
                                <td>{{ $item->crew }}</td>
                                <td>{{ $item->need_crew }}</td>
                                <td class="text-center">
                                    @if ($item->status_join == 'Pending')
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id_join_event}}">
                                            <i class="fa fa-edit"></i> 
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#Delete{{$item->id_join_event}}">
                                            <i class="fa fa-trash"></i> 
                                        </button>
                                        
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

@foreach ($data['join_event'] as $item)
<div class="modal fade" id="Update{{$item->id_join_event}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= url('update-join-event')?>" method="post" enctype='multipart/form-data'>
            @csrf
            <div class="modal-body">
                <input type="hidden" name = "id_join_event" value="{{$item->id_join_event}}">
                <p>Do you want to confirm the status of the event ?</p>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name = "konfirmasi" value="Accepted" class="btn btn-success">Accpeted</button>
            <button type="submit" name = "konfirmasi" value="Rejected" class="btn btn-danger">Rejected</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Delete{{$item->id_join_event}}">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
                <div class="modal-body">
                   <p>Are You Sure want to Delete?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{url('delete-join-event/'.$item->id_join_event)}}" class="btn btn-success">Delete</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
