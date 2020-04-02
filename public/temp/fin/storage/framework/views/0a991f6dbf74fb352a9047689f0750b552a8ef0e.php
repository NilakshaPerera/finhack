<?php $__env->startSection('content'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">    
    <div class="x_panel">
        <div class="x_title">
            <h2>Create User <small>Create new student.</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <form id="formadduser" name="formadduser" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST" action="<?php echo e(route('admin/user-create')); ?>">
                <?php echo csrf_field(); ?>
                <?php if (session('errors')) { ?>
                    <div class="form-group ">
                        <div class="col-md-6 col-sm-6 col-xs-12 center-margin text-center">
                            <div class="alert alert-danger">
                                <ul>
                                    <?php
                                    foreach (session('errors') as $error) {
                                        ?>
                                        <li> <?php echo e($error); ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtname"> Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtname" name="txtname" required="required" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtemail"> Username <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="txtusername" name="txtusername" required="required" value="" class="form-control col-md-7 col-xs-12" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtcontact"> Password <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtpassword" name="txtpassword" required="required" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtcontact"> University <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtuniversity" name="txtuniversity" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtcontact"> Lecturer <span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtlecturer" name="txtlecturer" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtcontact"> Team Name<span class="required"></span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="txtteam_name" name="txtteam_name" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <?php if (session('status')) { ?>
                    <div class="form-group ">
                        <div class="col-md-6 col-sm-6 col-xs-12 center-margin text-center">
                            <div class="alert alert-success"> <?php echo e(session('status')); ?></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

        <div class="x_content">
            <div class="table-responsive">
                <!--<table id="jstable" name="jstable" class="table table-striped jambo_table bulk_action">-->
                <table id="jstable" name="jstable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr class="headings">
                            <th class="column-title" style="display: table-cell;">Date</th>
                            <th class="column-title" style="display: table-cell;">Name</th>
                            <th class="column-title" style="display: table-cell;">Email</th>
                            <th class="column-title" style="display: table-cell;">University</th>
                            <th class="column-title" style="display: table-cell;">Lecturer</th>
                            <th class="column-title" style="display: table-cell;">Team Name</th>
                            <th class="column-title" style="display: table-cell;">Role</th>
                            <th class="column-title" style="display: table-cell;">Password</th>
                            <th class="column-title no-link last" style="display: table-cell;"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7" style="display: none;">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // role_id branch_id name email contact empid
                        foreach (App\User::where('role_id', 2)->orderBy('id', 'DESC')->get() as $user) {
                            ?>
                            <tr class="even pointer">
                                <td class=" "><?php echo $user->created_at->format('Y-m-d') ?></td>
                                <td class=" "><?php echo $user->name ?></td>
                                <td class=" "><?php echo $user->email ?></td>
                                <td class=" "><?php echo $user->university ?></td>
                                <td class=" "><?php echo $user->lecturer ?></td>
                                <td class=" "><?php echo $user->team_name?></td>
                                <td class=" "><?php echo $user->role->name ?></td>
                                <td class=" "><?php echo $user->raw_password ?></td>
                                <td class="last">
                                    <a href="<?php echo e(action('Admin\UserController@edit', $user->id )); ?>">
                                        <span class="label label-primary">Edit</span>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>