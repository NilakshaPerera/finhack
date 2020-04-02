<?php $__env->startSection('content'); ?>

<style>
    .container-custom {
        background-color: #fbfbff;
        padding: 20px 50px;
        width: 800px;
        margin: 0 auto;
        -webkit-box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 5px -1px rgba(0, 0, 0, 0.75);
    }

    .question-sec .question {
        margin-bottom: 10px;
    }

    .question-sec .question h1,
    .question-sec .question h2,
    .question-sec .question h3,
    .question-sec .question h4 {
        margin-top: 0px;
    }

    .question-sec .answers {
        margin-left: 20px;
    }

    .question-sec .correct {
        background-color: #c1f8c1;
    }

    .question-sec .student-answer {
        text-decoration: underline;
    }

    hr {
        border-color: #ededed;
    }

    .mb-5 {
        margin-bottom: 20px;
    }

    video {
        padding-top: 50px;
        width: 100% !important;
        height: auto !important;
    }
</style>

<?php
$mcqAns = 0;
$exam = \App\Exam::where('id', $data)->first();
$mcqs = $exam->mcq['mcqs'];
$presentation = $exam->presentation['presentations'];
$caseStudy = \App\Presentation::where('id',$presentation)->first();
$participants = $exam->user->participant;

$i = 0;

$started = $exam->mcq['started'];
$ended = $exam->mcq['ended'];

$startMcq = new DateTime(date('Y-m-d H:i:s', $started));
$endMcq = new DateTime(date('Y-m-d H:i:s', $ended));
$intervalMcq = $startMcq->diff($endMcq);
?>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="container-custom">
            <h3 class="text-center"><u>ACCA Finhack 2019</u></h3>
            </br>
          <h3><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal1">  <?php echo e($caseStudy->name); ?> </a></h3>
            </br>
            <?php
            if ($mcqs) {
                foreach ($mcqs as $mcq) {
                    $question = App\Question::where('id', $mcq['id'])->first();
                    if ($question) {
                        ?>
                        <div class="question-sec">
                            <div class="question">
                                <table>
                                    <tr>
                                        <td><?php echo $question->question; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <?php
                                        $answ = json_decode($question->answers, true);
                                        if ($mcq['ans'] == $question->answer) {
                                            $mcqAns++;
                                        }
                                        foreach ($answ as $index => $ans) {
                                            ?>
                                <span class="answers <?php echo e(($index == $question->answer) ? 'correct' : ''); ?> <?php echo e(($index == $mcq['ans']) ? 'student-answer' : ''); ?>">
                                    <?php echo e($index); ?> : <?php echo e($ans); ?>

                                </span>
                                </br>
                            <?php
                                        }
                                        ?>
                        </div>
                    <?php
                            }
                            ?>
                    <hr>
            <?php
                }
            }

            $started = $exam->presentation['started'];
            $ended = $exam->presentation['ended'];
            $startPresentation = new DateTime(date('Y-m-d H:i:s', $started));
            $endPresentation = new DateTime(date('Y-m-d H:i:s', $ended));
            $intervalPresentation = $startPresentation->diff($endPresentation);
            ?>
            <div class="mb-5">
                <h2 class=""><u>Section Presentation - <span title="Time taken to complete the Presentation (H:M:S)">(<?php echo e($intervalPresentation->format("%H:%i:%s")); ?>)</span></u></h2>
                <?php
                $tempo = $exam->presentation['ans'];

                if (empty($tempo)) {
                    ?>
                    <p>
                        <font size="3">The candidate has not uploaded the Presentation.</font>
                    </p>
                <?php } else { ?>
                    <a class="badge" target="_blank" href="<?php echo e(url('/') .'/uploads/presentation-answers/' . $exam->presentation['ans']); ?>">Presentation Answer Attachment</a>
                <?php } ?>
                <br>
                <br>
                <?php
                $tempor = $exam->presentation['vid'];
                if (empty($tempor)) {
                    ?>
                    <div>
                        <p>
                            <font size="3">The candidate has not uploaded the mind map.</font>
                        </p>
                    </div>
                <?php } else { ?>
                    <div>
                        <?php
                            $videofile = $exam->presentation['vid'];
                            function get_file_extention($file_name)
                            {
                                return pathinfo($file_name, PATHINFO_EXTENSION);
                            }
                            $temp = get_file_extention($videofile);

                            if ($temp !== 'mp4') {
                                ?>
                            <a class="badge" target="_blank" href="<?php echo e(url('/') .'/uploads/video-answers/' . $exam->presentation['vid']); ?>">Mind Map Answer Attachment</a>
                            <br>
                        <?php } else { ?>
                            <video controls autoplay="autoplay">
                                <source src="<?php echo e(url('/') .'/uploads/video-answers/' . $exam->presentation['vid']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                    </div>
                <?php
                    }
                    ?>
            </div>
        <?php } ?>

        <div class="ln_solid"></div>
        <form id="formadduser" name="formadduser" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST" action="<?php echo e(route('admin/score')); ?>">
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
            <input type="hidden" id="id" name="id" value="<?php echo e($data); ?>">
            <div class="form-group">
                <div class="col-md-4 col-sm-6 col-xs-12">
                <?php if(Auth::user()->role_id == 1){ ?>
                    <input placeholder="Presentation Score" type="number" id="presentation-score" name="presentation-score" required="required" value="<?php echo e(($exam->presentation_score == null)? '': $exam->presentation_score); ?>" class="form-control col-md-7 col-xs-12">
                    <?php }else{ ?>
                        <input placeholder="Presentation Score" type="number" id="presentation-score" name="presentation-score" required="required" value="<?php echo e(($exam->presentation_score == null)? '': $exam->presentation_score); ?>" class="form-control col-md-7 col-xs-12" disabled>
                        <?php } ?>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">

                    <button onclick="window.history.back()" class="btn btn-primary" type="button">Back</button>
                    <?php if(Auth::user()->role_id == 1){ ?>

                    <button type="submit" class="btn btn-success">Score</button>

                    <?php } ?>
                </div>
            </div>
            <?php if (session('status')) { ?>
                <div class="form-group ">
                    <div class="col-md-6 col-sm-6 col-xs-12 center-margin text-center">
                        <div class="alert alert-success"> <?php echo e(session('status')); ?></div>
                    </div>
                </div>
            <?php } ?>
        </form>



        <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone No</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            foreach ($participants as $participant) {
                                ?>
                                <tr>
                                    <td><?php echo e($participant->name); ?></td>
                                    <td><?php echo e($participant->email); ?></td>
                                    <td><?php echo e($participant->phone); ?></td>
                                    
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

<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e($caseStudy->name); ?>  </h4>

      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <?php echo $caseStudy->Body; ?>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>