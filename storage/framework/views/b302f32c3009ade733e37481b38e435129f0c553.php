<?php $__env->startSection('content'); ?>

<div class="col-md-12 col-sm-12 col-xs-12">    
    <div class="x_panel">
        <div class="x_title">
            <h2>Presentation <small>Create new presentations.</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="formaddquestion" name="formaddquestion" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST" action="<?php echo e(route('admin/presentation-create')); ?>">
                <?php echo csrf_field(); ?>
                <?php if (session('errors')) { ?>
                    <div class="form-group ">
                        <div class="col-md-6 col-sm-6 col-xs-12 center-margin text-center">
                            <div class="alert alert-danger">
                                <ul>
                                    <?php
                                    foreach (session('errors') as $error) {
                                        ?>
                                        <li><?php echo e($error); ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtname"> Presentation Title <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txttitle" name="txttitle" required="required" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtname"> Presentation Question Body <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="txttitle1" name="txttitle1" required="required" value="" class="form-control col-md-7 col-xs-12"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtname"> Clues <span class="required">*</span>
                    </label>
                    <div id="dynamic-answer-container" name="dynamic-answer-container" class="col-md-6 col-sm-6 col-xs-12">
                        <div id="" name="" class="dynamic-answer" >
                            <div class="col-md-10 col-sm-10 col-xs-11" style="margin-bottom: 5px; padding-left: 0">   
                                <textarea id='clue' name="txtanswers[]" required class="form-control col-md-7 col-xs-7"> </textarea>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"  style="margin-bottom: 5px;">  
                                <input onclick="clone($(this), <?php echo e(App\Setting::where('setting' , 'presentation_clue_count')->first()->data); ?> ,'dynamic-answer' , 'dynamic-answer-container' )" class="btn-add-question btn" type="button" value="+">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"  style="margin-bottom: 5px;">  
                                <input onclick="remove($(this) ,'dynamic-answer')" class="btn-add-question btn" type="button" value="-">
                            </div>
                        </div>
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
                            <th class="column-title" style="display: table-cell;">No</th>
                            <th class="column-title" style="display: table-cell;">Date</th>
                            <th class="column-title" style="display: table-cell;">Presentation Title</th>
                            <th class="column-title no-link last" style="display: table-cell;"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7" style="display: none;">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt">1 Records Selected</span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach (App\Presentation::get() as $presentation){
                            ?>
                            <tr class="even pointer">
                                <td class=""><?php echo $presentation->id ?></td>
                                <td class=""><?php echo $presentation->created_at->format('Y-m-d') ?></td>
                                <td class=""><?php echo $presentation->name ?></td>
                                <td class="last">
                                    <a href="<?php echo e(action('Admin\PresentationController@edit', $presentation->id )); ?>">
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

<?php $__env->startSection('scripts'); ?>
<script>
 $('#txttitle1').summernote({
       height: 200,
       followingToolbar: false
   });
</script>    
<script>
 $('#clue').summernote({
       height: 100,
       followingToolbar: false
   });
</script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>