
@include('admin.layout.head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  @include('admin.layout.header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.layout.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="col-md-12">
      
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
          <span class="glyphicon glyphicon-plus" ></span> Add Sekolah
        </button>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="background-color: rgb(60, 141, 188)">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #fff">Modal Header</h4>
              </div>
              <form method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                      <label for="Username">Username:</label>
                      <input type="text" class="form-control" name="username" required="required">
                    </div>
                    <div class="form-group">
                      <label for="Email">Email:</label>
                      <input type="email" class="form-control" name="email" required="required">
                    </div>
                    <div class="form-group">
                      <label for="Password">Password:</label>
                      <input type="password" class="form-control" name="password" required="required">
                    </div>
                    <div class="form-group">
                      <label for="Nama">Nama:</label>
                      <input type="email" class="form-control" name="nama" required="required">
                    </div>
                    <div class="form-group">
                      <label for="tb">Tanggal Berdiri:</label>
                      <input type="date" class="form-control" name="tanggal_berdiri" required="required">
                    </div>
                    <div class="form-group">
                      <label for="no_handphone">No Handphone:</label>
                      <input type="number"  class="form-control" name="no_handphone" required="required" pattern="[0-9]*" value="" type="number" onkeypress="preventNonNumericalInput(event)">
                    </div>


                    <div class="form-group">
                      <label for="Alamat">Alamat:</label>
                      <input type="text" class="form-control" name="alamat" required="required">
                    </div>
                    <div class="form-group">
                      <label for="Website">Website:</label>
                      <input type="text" class="form-control" name="website" required="required">
                    </div>
                    <div class="form-group">
                      <label for="Accept">Accept:</label>
                      <label class="toggle-check">
                              <input type="checkbox" class="toggle-check-input hidden" />
                              <span class="toggle-check-text" name="accept"></span>
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Keterangan:</label>
                      <textarea type="text" class="form-control" name="keterangan"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="email">Image:</label>
                      <input type="file" class="form-control" name="image">
                    </div>
                  </div>
                <div class="modal-footer">
                  <input class="btn btn-primary" type="submit" value="Create"></button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title">Registered Sekolah User</h3>
              <div class="box-body">
              <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Nama Sekolah</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Handphone</th>
                        <th>Accept</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>081217302696</td>
                        <td><label class="toggle-check">
                            <input type="checkbox" class="toggle-check-input hidden" />
                            <span class="toggle-check-text"></span>
                        </label></td>
                        <td>
                           <a href="#"><span class="glyphicon glyphicon-eye-open"></span></a>
                           <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                           <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              </div>
          </div>
        </div>
      </div>

    </section>

  </div>
  
  <!-- Main Footer -->
  @include('admin.layout.footer')

  @yield('javascript')
  <script>
    function preventNonNumericalInput(e) {
      e = e || window.event;
      var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
      var charStr = String.fromCharCode(charCode);

      if (!charStr.match(/^[0-9]+$/))
        e.preventDefault();
    }
  </script>

</body>
</html>