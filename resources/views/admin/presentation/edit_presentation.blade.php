@extends('layouts.admin')
@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">    
    <div class="x_panel">
        <div class="x_title">
            <h2>Update Presentation <small>Update the Presentation.</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="formadduser" name="formadduser" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="POST" action="{{ route('admin/presentation-update') }}">
                @csrf
                <?php if (session('errors')) { ?>
                    <div class="form-group ">
                        <div class="col-md-6 col-sm-6 col-xs-12 center-margin text-center">
                            <div class="alert alert-danger">
                                <ul>
                                    <?php
                                    foreach (session('errors') as $error) {
                                        ?>
                                        <li>{{ $error }}</li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtname"> Question Title <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input value="{{ $data['presentation']->name }}" id="txttitle" name="txttitle" required="required" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtname"> Presentation Question Body <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="txttitle1" name="txttitle1" required="required" value="" class="form-control col-md-7 col-xs-12">
                        {{ $data['presentation']->Body }}
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtname"> Clues <span class="required">*</span>
                    </label>
                    <div id="dynamic-answer-container" name="dynamic-answer-container" class="col-md-6 col-sm-6 col-xs-12">
                        
                        <?php   
                        $answers = json_decode( $data['presentation']->clues , true);
                        foreach( $answers as $answer){
                        ?>
                        <div id="" name="" class="dynamic-answer" >
                            <div class="col-md-10 col-sm-10 col-xs-11" style="margin-bottom: 5px; padding-left: 0">   
                                <input value="{{ $answer }}" name="txtanswers[]" required class="form-control col-md-7 col-xs-12"> 
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"  style="margin-bottom: 5px;">  
                                <input onclick="clone($(this) , {{ App\Setting::where('setting' , 'presentation_clue_count')->first()->data }} ,'dynamic-answer' , 'dynamic-answer-container')" class="btn-add-question btn" type="button" value="+">
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"  style="margin-bottom: 5px;">  
                                <input onclick="remove($(this) ,'dynamic-answer')" class="btn-add-question btn" type="button" value="-">
                            </div>
                        </div>
                        <?php   
                        }
                        ?>
                        
                    </div>
                </div>
                <?php if (session('status')) { ?>
                    <div class="form-group ">
                        <div class="col-md-6 col-sm-6 col-xs-12 center-margin text-center">
                            <div class="alert alert-success"> {{ session('status') }}</div>
                        </div>
                    </div>
                <?php } ?>
                <div class="ln_solid"></div>
                <input id="hash" name="hash" type="hidden" value="{{ $data['presentation']->id }}">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                         <button onclick="window.location = '{{url('/admin/presentations')}}'" class="btn btn-primary" type="button">Back</button>
                        <button class="btn btn-primary" type="reset">Reset</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
 $('#txttitle1').summernote({
       height: 200,
       followingToolbar: false
   });
</script>    

@endsection