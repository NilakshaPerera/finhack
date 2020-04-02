<template>
<div id="" name="" class="auth-box d-flex justify-content-center align-items-center"> <!-- justify-content-center -->
    <div class="box">
        <div class="inner-box">
            <div class="row">
                <div class=" col-md-12">
                    
                    <!-- <button type="button" class="btn acca-btn float-right mb-2" data-toggle="modal" data-target="#myModal">Open Case Study</button> -->
                    <a data-toggle="modal" data-target="#myModal" class="float-right mb-2" href="#">Case Study</a>
                    <div class="p-2" v-bind:style="styleObject1">
                      <h2 class="text-center mb-3">Questios</h2>
                    <h5 class="mb-4" v-for="(item ,  index) in clues" :key="index">
                       <p  class="mb-4 w-100" v-html="item"></p>
                       </h5>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class=" col-md-12">
                <form @submit="formCompletePresentation" class="mt-2">
                    <div class="form-actions">
                        <div class="text-center">
                            <div class="row">
                               
                                    <div class="col-md-6">
                                        <div class="file-upload">
                                        <label for="file" class="btn   acca-btn  ">{{ uploadLabel }}</label>
                                        <input v-on:change="handleFileUpload()" id="file" ref="file" class="file-upload__input" type="file" name="file" accept="application/vnd.ms-powerpoint">
                                        <div>
                                          
                                        <label for="file1" class="btn   acca-btn  ">{{ uploadLabel1 }}</label>
                                            <input  v-on:change="handleFileUpload1()" id="file1" ref="file1" class="file-upload__input" type="file" name="file1" accept="video/3gpp,video/mp4,video/mpeg,video/quicktime,video/webm,video/x-flv,video/x-m4v,video/x-ms-wmv,video/x-msvideo,,image/*,application/pdf,application/vnd.ms-excel,application/vnd.ms-word,application/vnd.ms-powerpoint">
                                          <br>
                                         
                                          <br>
                                        </div>

                                        </div>
                                    </div>
                                   
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <button @click="stop" type="button" class=" btn acca-btn">Finish</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade custom-modal custom-modal1"  id="modalProgress" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-body">
                <div  class="progress">
                    <div class="progress-bar bg-info" role="progressbar" v-bind:style="styleObject" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="modal-footer" v-bind:style="styleObjectBtn" >
              <button type="button"   class="btn acca-btn" data-dismiss="modal">Close</button>
            </div>
      </div>
       </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title">Case Study</h4>
      </div>
        <div id="card-con-wrap" v-bind:style="styleObject2" v-html="Body">
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn acca-btn" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
</template>

<script>
import timer from "../../timer.js";



export default {
  beforeCreate: function() {
    document.body.className = "present-in-progress ";
  },
  
 
  data() {
    return {
      clues: [],
      uploadLabel: "Upload Answer",
      uploadLabel1: "Upload Video",
      file: '',
       file1: '',
      uploadPercentage: 0,
     styleObject: {
    width : '0%'
  },
    styleObject1: {
        borderRadius: '10px',
        backgroundColor: 'white',
        width:'100%',
        height:'300px',
        overflowY: 'scroll',
        overflowX:'hidden',
        paddingRight:'10px'
  },
   styleObject2: {
    width:'100%',
        height:'500px',
        overflowY: 'scroll',
        overflowX:'hidden',
        paddingBottom:'5px'
  },
    styleObjectBtn:{
     display: 'none',
    }
    };
  },
  mounted() {
    let currentObj = this;
    timer.jinjibiris(currentObj, null, 3, "presentation");

    currentObj.getPresentation();

    console.log("presentation Component mounted.");
    
  },
  methods: {
    getPresentation() {
      let currentObj = this;
      axios
        .get("/getPresentation")
        .then(function(response) {
          console.log(response.data.a.clues);
          if (response.data.success) {
            currentObj.Body = response.data.a.Body;
            currentObj.clues = JSON.parse(response.data.a.clues);
            currentObj.uploadLabel = response.data.ans
              ? "Presentation Uploaded"
              : "Upload Presentation";
            currentObj.uploadLabel1 = response.data.vid
              ? "Mind Map Uploaded"
              : "    Upload Mind Map    ";
          } else {
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    formCompletePresentation(e) {
      e.preventDefault();
      let currentObj = this;
      currentObj.$router.push("/presentation-complete");
    },
    stop() {
      let options = {
        html: true, // set to true if your message contains HTML tags. eg: "Delete <b>Foo</b> ?"
        loader: false, // set to true if you want the dailog to show a loader after click on "proceed"
        reverse: false, // switch the button positions (left to right, and vise versa)
        okText: "Continue",
        cancelText: "Cancel",
        animation: "fade", // Available: "zoom", "bounce", "fade"
        type: "basic", // coming soon: 'soft', 'hard'
        verification: "continue", // for hard confirm, user will be prompted to type this to enable the proceed button
        verificationHelp: 'Type "[+:verification]" below to confirm', // Verification help text. [+:verification] will be matched with 'options.verification' (i.e 'Type "continue" below to confirm')
        clicksCount: 3, // for soft confirm, user will be asked to click on "proceed" btn 3 times before actually proceeding
        backdropClose: false, // set to true to close the dialog when clicking outside of the dialog window, i.e. click landing on the mask
        customClass: "conf-dialog" // Custom class to be injected into the parent node for the current dialog instance
      };
      this.$dialog
        .confirm(
          "<h4>Are you sure you want to finish and proceed?</h4>",
          options
        )
        .then(function() {
          timer.stopTimer();
        })
        .catch(function() {});
    },
    handleFileUpload() {
     
      let currentObj = this;
      var instance=this;
      this.file = this.$refs.file.files[0];
      this.uploadLabel = this.file["name"];
      console.log(this.file["name"]);

      let formData = new FormData();
      formData.append("file", this.file);
      currentObj.styleObject.width  = "0%";
      currentObj.styleObjectBtn.display ='none';
      timer.modalshow();
      axios
        .post(base + "/markPresentation", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          },
          onUploadProgress: function(e){
            currentObj.styleObject.width = Math.floor((e.loaded * 100) / e.total) + "%";
          }.bind(this)
      
        })
        .then(function(response) {
          if (response.data.success) {
            currentObj.uploadLabel = "Presentation Uploaded";
          } else {
          }
          timer.modalhide();
           currentObj.styleObjectBtn.display ='block';
        })
        .catch(function(error) {
          console.log(error);
        });
    },
     handleFileUpload1() {
      let currentObj = this;
      this.file1 = this.$refs.file1.files[0];
      this.uploadLabel1 = this.file1["name"];
      console.log(this.file1["name"]);

      let formData = new FormData();
      formData.append("file", this.file1);
      currentObj.styleObject.width  = "0%";
      currentObj.styleObjectBtn.display ='none';
      timer.modalshow();
      axios
        .post(base + "/markVideos", formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          },
          onUploadProgress: function(e){
            currentObj.styleObject.width = Math.floor((e.loaded * 100) / e.total) + "%";
          }.bind(this)
        })
        .then(function(response) {
          if (response.data.success) {
            currentObj.uploadLabel1 = "Mind Map Uploaded";
            //timer.modalhide();
          } else {
          } 
          timer.modalhide();
          currentObj.styleObjectBtn.display ='block';
        })
        .catch(function(error) {
          console.log(error);
        });
    },
   
  }
};

</script>