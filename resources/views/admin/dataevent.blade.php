@extends('template.master')
@section('contents')


<section class="section">
  <div class="section-header" style="background-color : #FAEFCC !important">
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
                            <th>Title</th>
                            <th>Date Start</th>
                            <th>Date Finish</th>
                            <th>Crew</th>
                            <th>Created</th> 
                            <th>Image</th> 
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        @foreach ($data['event'] as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$item->judul}}</td>
                                <td>{{$item->tanggal_mulai}}</td>
                                <td>{{$item->tanggal_selesai}}</td>
                                <td>{{$item->crew}}</td>
                                <td>{{$item->created_at}}</td>
                                <td width="15%"><img src="{{url('event/'.$item->gambar_event)}}" alt="" width="100%"></td>
                            
                                <td width = "10%" class="text-center">
                                    <a href="{{url('detail-event/'.$item->id_event)}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update{{$item->id_event}}">
                                        <i class="fa fa-edit"></i> 
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$item->id_event}}">
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
        <form action="<?= url('insert-event')?>" method="post" enctype='multipart/form-data'>
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="">Title</label>
              <input type="text" name="judul" id="" class="form-control" required>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Date Start</label>
                  <input type="datetime-local" name="tanggal_mulai" id="" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Date Finish</label>
                  <input type="datetime-local" name="tanggal_selesai" id="" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea name="deskripsi" id="" cols="30" rows="10" class = "form-control summernote" required></textarea>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Size Of Event</label>
                  <input type="number" name="size_of_event" id="" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Crew</label>
                  <input type="number" name="crew" id="" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="">Location</label>
              <input type="text" name="lokasi" id="" class="form-control" required>
            </div>
            <div class="form-group">
              <label class="form-label">Need Crew</label>
              <div class="selectgroup selectgroup-pills">
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="PIC Event" class="selectgroup-input" >
                  <span class="selectgroup-button">PIC Event</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="PIC Consumption" class="selectgroup-input">
                  <span class="selectgroup-button">PIC Consumption</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="PIC Arena" class="selectgroup-input">
                  <span class="selectgroup-button">PIC Arena</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="PIC Sound" class="selectgroup-input">
                  <span class="selectgroup-button">PIC Sound</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="Arena Member" class="selectgroup-input">
                  <span class="selectgroup-button">Arena Member</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="Sound Member" class="selectgroup-input">
                  <span class="selectgroup-button">Sound Member</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="Consumption Member" class="selectgroup-input">
                  <span class="selectgroup-button">Consumption Member</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="MC" class="selectgroup-input">
                  <span class="selectgroup-button">MC</span>
                </label>
                <label class="selectgroup-item">
                  <input type="checkbox" name="need_crew[]" value="Other" class="selectgroup-input">
                  <span class="selectgroup-button">Other</span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <label for="">Image</label>
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

@foreach ($data['event'] as $item)
<div class="modal fade" id="Update{{$item->id_event}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= url('update-event')?>" method="post" enctype='multipart/form-data'>
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="">Title</label>
              <input type="hidden" name = "id_event" value = "<?= $item->id_event?>">
              <input type="text" name="judul" id="" class="form-control" required value = "{{$item->judul}}">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Date Start</label>
                  <input type="datetime-local" name="tanggal_mulai" id="" class="form-control" required value = "<?= $item->tanggal_mulai?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Date Finish</label>
                  <input type="datetime-local" name="tanggal_selesai" id="" class="form-control" required value = "<?= $item->tanggal_selesai?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="">Deskripsi</label>
              <textarea name="deskripsi" id="" cols="30" rows="10" class = "form-control summernote" required><?= $item->deskripsi?></textarea>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Size Of Event</label>
                  <input type="number" name="size_of_event" id="" class="form-control" required value = "{{$item->size_of_event}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Crew</label>
                  <input type="number" name="crew" id="" class="form-control" required value = "{{$item->crew}}">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="">Location</label>
              <input type="text" name="lokasi" id="" class="form-control" required value = "{{$item->lokasi}}">
            </div>
            <div class="form-group">
              <label class="form-label">Need Crew</label>
              <div class="selectgroup selectgroup-pills">
                @php
                  $pic_event = false;
                  $pic_consumption = false;   
                  $pic_arena = false;
                  $pic_sound = false;
                  $arena_member = false;
                  $sound_member = false;
                  $consumption_member = false;
                  $other = false;
                @endphp
                @foreach ($item->need_crew as $value)
                    @if ($value->need_crew == 'PIC Event')
                      @php $pic_event = true; @endphp
                    @elseif($value->need_crew == 'PIC Consumption')
                      @php $pic_consumption = true; @endphp
                    @elseif($value->need_crew == 'PIC Arena')
                      @php $pic_arena = true; @endphp
                    @elseif($value->need_crew == 'PIC Sound')
                      @php $pic_sound = true; @endphp
                    @elseif($value->need_crew == 'Arena Member')
                      @php $arena_member = true; @endphp
                    @elseif($value->need_crew == 'Sound Member')
                      @php $sound_member = true; @endphp
                    @elseif($value->need_crew == 'Consumption Member')
                      @php $consumption_member = true; @endphp
                    @elseif($value->need_crew == 'Other')
                      @php $other = true; @endphp
                    @endif
                @endforeach
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="PIC Event" class="selectgroup-input" {{ $pic_event == true ? 'checked' : '' }}>
                    <span class="selectgroup-button">PIC Event</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="PIC Consumption" {{ $pic_consumption == true ? 'checked' : '' }} class="selectgroup-input">
                    <span class="selectgroup-button">PIC Consumption</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="PIC Arena" {{ $pic_arena == true ? 'checked' : '' }} class="selectgroup-input">
                    <span class="selectgroup-button">PIC Arena</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="PIC Sound" {{ $pic_sound == true ? 'checked' : '' }} class="selectgroup-input">
                    <span class="selectgroup-button">PIC Sound</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="Arena Member" {{ $arena_member == true ? 'checked' : '' }} class="selectgroup-input">
                    <span class="selectgroup-button">Arena Member</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="Sound Member" {{ $sound_member == true ? 'checked' : '' }} class="selectgroup-input">
                    <span class="selectgroup-button">Sound Member</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="Consumption Member" {{ $consumption_member == true ? 'checked' : '' }} class="selectgroup-input">
                    <span class="selectgroup-button">Consumption Member</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="checkbox" name="need_crew[]" value="Other" {{ $other == true ? 'checked' : '' }} class="selectgroup-input">
                    <span class="selectgroup-button">Other</span>
                  </label>
              </div>
            </div>
            <div class="form-group">
              <label for="">Image</label>
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
<div class="modal fade" id="Delete{{$item->id_event}}">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
           
                <div class="modal-body">
                   <p>Are You Sure to Delete?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <a href="{{url('delete-event/'.$item->id_event)}}" class="btn btn-success">Delete</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
