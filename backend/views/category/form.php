<?php include_once __DIR__ . "/../header.php"; ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-info">
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" action="http://alif/backend/index.php?model=category&action=save" method="post">
                <div class="card-body">
                    <input type="hidden" value="<?=$one['id'] ?? ''?>"  name="id">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['title'] ?? ''?>" name="title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">groupId</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['group_id'] ?? ''?>" name="group_id" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">parentId</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['parent_id'] ?? ''?>" name="parent_id" class="form-control">
                        </div>
                    </div>
					<div class="form-group row">
                        <label class="col-sm-2 col-form-label">prior</label>
                        <div class="col-sm-10">
                            <input type="text" value="<?=$one['prior'] ?? ''?>" name="prior" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<?php include_once __DIR__ . "/../footer.php"; ?>