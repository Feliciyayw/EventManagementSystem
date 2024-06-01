@extends('template_users.master')
@section('contents')
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Profile Users</h2>
              {{-- <p>Charity selalu mengadakan event yang menarik, dan siapapun boleh untuk ikut serta berpartisipasi dalam event tersebut</p> --}}
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="{{url('')}}">Home</a></li>
            <li>Profile Users</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row d-flex justify-content-center">
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
            <div class="col-lg-12 col-12">
                <h2 class="fs-5 py-4 text-center">
                   Profile
                </h2>
                <div class="card border rounded shadow">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{url('update-profile-users')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="hidden" name = "id_users" value="{{$data['detail']->id}}">
                                <input type="text" name = "name" class="form-control" required value="{{$data['detail']->name}}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name = "email" class="form-control" required value="{{$data['detail']->email}}">
                                    </div>   
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No Telepon</label>
                                        <input type="number" name = "phone_number" class="form-control" required value="{{$data['detail']->phone_number}}">
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name = "tgl_lahir" class="form-control" required value="{{$data['detail']->tgl_lahir}}">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="" required value="">
                                    <option value="{{$data['detail']->jenis_kelamin}}">{{$data['detail']->jenis_kelamin}}</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>   
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat"  class="form-control" required value="{{$data['detail']->alamat}}" cols="30" rows="3">{{$data['detail']->alamat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name = "password" class="form-control" required >
                            </div>
                            <div class="text-right">
                               
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

         </div>
    </section><!-- End Blog Section -->

@endsection