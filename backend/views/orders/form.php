<?php 
    include_once __DIR__ . "/../header.php"; 
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-info">
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="http://alif/backend/index.php?model=order&action=update" method="post">
                <div class="card-body">
                    <input type="hidden" value="<?=$one['id'] ?? ''?>"  name="id">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">User Id</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['user_id'] ?? ''?>" name="user_id" readonly class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['total'] ?? ''?>" name="total" readonly class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Delivery</label>
                        <div class="col-sm-10">
                            <select name="delivery">
                                <option disabled selected></option>
                                <option value="1" <?=($one['delivery_id'] ?? null == '1') ? 'selected' : ''?>>Delivery 1</option>
                                <option value="2" <?=($one['delivery_id'] ?? null == '2') ? 'selected' : ''?>>Delivery 2</option>
                                <option value="3" <?=($one['delivery_id'] ?? null == '3') ? 'selected' : ''?>>Delivery 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Payment</label>
                        <div class="col-sm-10">
                            <select name="payment">
                                <option disabled selected></option>
                                <option value="1" <?=($one['payment_id'] ?? null == '1') ? 'selected' : ''?>>Payment 1</option>
                                <option value="2" <?=($one['payment_id'] ?? null == '2') ? 'selected' : ''?>>Payment 2</option>
                                <option value="3" <?=($one['payment_id'] ?? null == '3') ? 'selected' : ''?>>Payment 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Comment</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['comment'] ?? ''?>" name="comment" readonly class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['name'] ?? ''?>" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['phone'] ?? ''?>" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['email'] ?? ''?>" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status">
                                <option disabled selected></option>
                                <?php foreach (OrderService::getStatuses() as $key => $label) : ?>
                                    <option value="<?=$key?>" <?=($one['status'] ?? null === $key) 
                                        ? 'selected' : ''?>><?=$label?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Created</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['created'] ?? ''?>" readonly name="created" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Updated</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['updated'] ?? ''?>" readonly name="updated" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php include_once __DIR__ . "/../footer.php"; ?>