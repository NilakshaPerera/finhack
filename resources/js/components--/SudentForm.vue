<template>
<div id="" name="" class="auth-box d-flex justify-content-center align-items-center">
<div class="box">
   <h2 class="text-center mb-3">Please enter your team details</h2>
    <form @submit="formUpdateTeam" id="frmstudent" name="frmstudent" class="form-element">

         <div class="form-group row  mb-4">
           <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
            <input v-model="lead" type="text" class="form-control" placeholder="Team Lead">
        </div>
        </div>

        <div class="form-group row mb-4">
          <label for="staticEmail" class="col-sm-4 col-form-label">University</label>
            <div class="col-sm-8">
             <input v-model="university" type="text" class="form-control" placeholder="University">
            </div>
        </div>

        <div class="form-group row mb-4">
          <label for="staticEmail" class="col-sm-4 col-form-label">Lecturer</label>
            <div class="col-sm-8">
            <input v-model="lecturer" type="text" class="form-control" placeholder="Lecturer">
        </div>
        </div>

        <div class="form-group row mb-4">
          <label for="staticEmail" class="col-sm-4 col-form-label">Team Name</label>
            <div class="col-sm-8">
            <input v-model="team_name" type="text" class="form-control" placeholder="Team Name">
        </div>
        </div>

        <div class="form-actions">
            <div class="text-right">
                <button type="submit" class="btn   acca-btn  ">Next</button>
            </div>
            <div class="text-center">
              {{output}}
            </div>
        </div>
    </form>
</div>

</div>
</template>

<script>
export default {
   beforeCreate: function() {
        document.body.className = 'default  ';
    },
  data() {
    return {
      lead: "",
      university: "",
      lecturer: "",
      team_name: "",
      output: ""
    };
  },
  mounted() {
    console.log("StudentForm Component mounted.");
    let currentObj = this;
    axios
      .get(base +"/student")
      .then(function(response) {
        console.log(response)
        currentObj.lead = response.data.data.name;
        currentObj.university = response.data.data.university;
        currentObj.lecturer = response.data.data.lecturer;
         currentObj.team_name = response.data.data.team_name;
      })
      .catch(function(error) {
        console.log(error);
      });
  },
  methods: {
    formUpdateTeam(e) {
      e.preventDefault();
      let currentObj = this;
      axios
        .post(base + "/student", {
          university : this.university,
          lecturer : this.lecturer,
          team_name: this.team_name
        })
        .then(function(response) {
          if (response.data.success) {
            currentObj.output = response.data.message[0];
           currentObj.$router.push('/instructions');
          } else {
            currentObj.output = response.data.errors[0];
          }
        })
        .catch(function(error) {
          currentObj.output = error;
        });
    }
  }
};
</script>
