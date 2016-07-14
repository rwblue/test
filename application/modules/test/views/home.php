<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
        <?php echo form_open(''); ?>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name">
          </div>
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Address" name="address">
          </div>
          <button type="button" class="btn btn-default" id="btnSubmit">Submit</button>
        <?php echo form_close() ?>
        </div>
      </div>
    </div>

    <div class="container">
    <div class="row">
      <div class="col-md-8">
      <table class="table table-hover"> 
        <thead>
          <tr>
            <th>Id Customer</th>
            <th>Name</th>
            <th>Address</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($init as $key => $val): ?>
          <tr>
            <th scope="row"><?php echo $val['uuid'] ?></th>
            <td><?php echo $val['name'] ?></td>
            <td><?php echo $val['address'] ?></td>
          </tr> 
          <?php endforeach; ?>
        </tbody>
      </table>
      <button type="button" class="btn btn-default" id="btnRefresh">Refresh</button>
      </div>
    </div>
    </div>

    <script src="<?php echo base_url('assets/js/vendor/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script>
      $(document).ready(function () {
        $('#btnSubmit').on('click',function(e){
          e.preventDefault();
          $.ajax({
              'type': "POST",
              'url': "<?php echo base_url('test/home/request'); ?>",
              'data': $("form").serialize(),
              success: function (response)
              {
                  var obj = jQuery.parseJSON(response);
                  if(obj.success == 'false')
                  {
                    alert('Failed to save');
                  }
                  else
                    location.reload();
              },
              complete: function()
              {

              }
          });
          return false;
        })

        $('#btnRefresh').on('click',function(e){
          location.reload();
        });
      });
    </script>
  </body>
</html>