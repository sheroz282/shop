<?php include_once __DIR__ . "/../header.php"; ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-striped projects">
          <thead>
        <th>ID</th>
        <th>User Id</th>
        <th>Total</th>
        <th>Payment</th>
        <th>Delivery</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
    </thead>
    <tbody>
        <?php foreach ($all as $p) : ?>
        <tr>
            <td><?=$p['id']?></td>
            <td><?=$p['user_id']?></td>
            <td><?=$p['total']?></td>
            <td><?=$p['payment_id']?></td>
            <td><?=$p['delivery_id']?></td>
            <td><?=$p['name']?></td>
            <td><?=$p['phone']?></td>
            <td><?=$p['email']?></td>
            <td><?=$p['status']?></td>
            <td><?=$p['created']?></td>
            <td><?=$p['updated']?></td>
            <td>
                <a class="btn btn-info btn-sm" href="http://alif/backend/index.php?model=order&action=update&id=<?=$p['id']?>">
                    <i class="fas fa-pencil-alt">
                    </i>
                    Edit
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once __DIR__ . "/../footer.php"; ?>