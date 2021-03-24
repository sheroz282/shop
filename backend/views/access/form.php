<?php 
    include_once __DIR__ . "/../header.php"; 
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ACCESS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">ACCESS</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-info">
            <!-- form start -->
            <form class="form-horizontal" action="http://alif/backend/index.php?model=access&action=save" method="post">
                <div class="card-body">
                    <table id="access-table">
                        <thead>
                            <tr>
                                <td></td>
                                <?php foreach ($roles as $role) : ?>
                                    <td><div><span><?=$role?></span></div></td>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php foreach ($permissions as $permission) : ?>
                                <tr>
                                    <td><?=$permission?></td>
                                    <?php foreach ($roles as $role) : ?>
                                        <td><input type="checkbox" <?=(isset($accesses[$role][$permission])) 
                                            ? 'checked="checked"' : ''?> 
                                            name="access[<?=$role?>][<?=$permission?>]"></td>
                                    <?php endforeach; ?>
                                </tr>  
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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

<?php 
    include_once __DIR__ . "/../footer.php"; 
?>