<template>
<div id="" name="" class="auth-box d-flex justify-content-center align-items-center">
    <div class="box">
        <div class="inner-box">
            <div class="row">
                <div class=" col-md-12">
                    <h2 class="text-center mb-3">{{ name }}</h2>
                    <div id="card-con-wrap" v-bind:style="styleObject" v-html="Body">
                       
                        </div>
                    
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class=" col-md-12">
                <form  @submit="formProceedPresentation" class="">
                    <div class="form-actions">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn   acca-btn mt-2 ">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  beforeCreate: function() {
    document.body.className = "present-in-progress";
  },
  data() {
    return {
        name:'',
        Body:' ',
        styleObject:{  
        width:'100%',
        height:'300px',
        overflowY: 'scroll',
        overflowX:'hidden',
        paddingBottom:'5px'
        },
       
    };
  },
  mounted() {
    console.log("presInstruction Component mounted.");
    let currentObj = this;
    currentObj.getPresentationData();

  },
  methods: {
      getPresentationData() {
      let currentObj = this;
      axios
        .get(base + "/getPresentation")
        .then(function(response) {
         
          if (response.data.success) {
             
            
            currentObj.name = response.data.a.name;
            currentObj.Body = response.data.a.Body;
          } else {
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    formProceedPresentation(e) {
      e.preventDefault();
      let currentObj = this;
      currentObj.$router.push("/presentation");
    }
  }
};
</script>