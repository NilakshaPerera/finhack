<template>
<div id="" name="" class="auth-box d-flex justify-content-center align-items-center">
<div class="box">
   <h3 class="text-center mb-3">Round One Instructions</h3>
   <p class="text-center mb-4">
Lorem ipsum dolor sit amet consectetur adipisicing elit. Error ipsam cumque, sed quis sapiente qui incidunt possimus exercitationem totam eos ullam saepe tempore neque voluptatem iste reiciendis eaque ducimus facere.   </p>
    <h3 class="text-center mb-3">Round Two Instructions</h3>
   <p class="text-center mb-4">
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et ullam esse necessitatibus repudiandae impedit, sunt illo incidunt deleniti numquam, quo commodi error temporibus totam id eligendi? Voluptatibus aliquam ipsa labore.   </p>
    <!-- <h3 class="text-center mb-4">Round Three Instructions</h3>
   <p class="text-center mb-4">
       It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
   </p> -->
    <form  @submit="formProceedInstructions" class="form-element">
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
      return {};
  },
  mounted() {
    console.log("Instructions Component mounted.");
  },
  methods: {
    formProceedInstructions(e) {
      e.preventDefault();
      let currentObj = this;
    /* this was changed */
      currentObj.$router.push('/presentation-instructions');
    }
  }
};
</script>