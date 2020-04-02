<template>
<div id="" name="" class="auth-box d-flex justify-content-center align-items-center">
<div class="box">
  <div class="box" v-bind:style="styleObject">
    <h3 class="text-center mb-3">Teams will get a real life case study with two questions to answer.</h3>
   <p class="text-center mb-4">
·        First question is to develop a mind map summarizing the case study and the second question will require financial and business solutions to finance and business related problem. </p>
    <p class="text-center mb-4">
·        Teams should spend forty five minutes initially to read through the case study and to develop a mind map.</p>
    <p class="text-center mb-4">
·        Thereafter another forty five minutes will be given to develop five power point slides with solutions to the second question. </p> 
    <p class="text-center mb-4">
·        In total the teams will have one hour and thirty minutes and within this time frame the teams will have to upload their work.</p>
    <p class="text-center mb-4">
·        Thereafter the presentations will begin.</p>
    <p class="text-center mb-4">
·        Ten minutes will be allocated for each team to present. Five minutes will be allocated for Q&A. Therefore in total fifteen minutes will be allocated for each team.</p>
    <p class="text-center mb-4">
·        All members in the team should present and marks will be allocated as per the marking guide which was shared with all of you before.</p>
    <p class="text-center mb-4">
·        Judges decision would be final.</p>
    <p class="text-center mb-4">
·        Based on the marks allocated a winner and a runner up for each case study will be chosen. </p>
    <!-- <h3 class="text-center mb-4">Round Three Instructions</h3>
   <p class="text-center mb-4">
       It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
   </p> -->
   </div>
   
    <form  @submit="formProceedInstructions" class="form-element mt-4">
         <div class="form-actions">
            <div class="text-right">
                <button type="submit" class="btn   acca-btn  ">Next</button>
            </div>
            <div class="text-center">
            </div>
        </div>
    </form>

</div>
</div>
</template>

<script>
export default {
       beforeCreate: function() {
        document.body.className = 'default ';
    },
  data() {
      return {
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
    console.log("Instructions Component mounted.");
  },
  methods: {
    formProceedInstructions(e) {
      e.preventDefault();
      let currentObj = this;
    /* this was changed */
      currentObj.$router.push('/presentation');
    }
  }
};
</script>