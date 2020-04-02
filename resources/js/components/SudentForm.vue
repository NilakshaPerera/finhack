<template>
<div id="" name="" class="auth-box d-flex justify-content-center align-items-center">
<div class="box">
   <h2 class="text-center mb-3">Please enter your team details</h2>
    <form @submit="formUpdateTeam" id="frmstudent" name="frmstudent" class="form-element">
          <div id="demo" class="form-group row  mb-4">
            <input class="btn acca-btn" type="button" @click="AddField" value="add team member details">
            <br>
          <div class="border" v-for="(item, i) in field0" >
            <!-- <input type="hidden" v-model="field0[i]" > -->
            <input class="col-sm-3" v-model="field1[i]" placeholder="Name">
            <input class="col-sm-3" v-model="field2[i]" placeholder="Email">
            <input class="col-sm-3" v-model="field3[i]" placeholder=" P No">
            <input  class="btn btn-success col-sm-1 " type="button" @click="AddField" value="+">
            <input class="btn btn-danger col-sm-1" type="button" @click="removeField" value="-">
          </div>
          
          </div>
         <!-- <div class="form-group row  mb-4">
           <label for="staticEmail" class="col-sm-4 col-form-label">Name</label>
            <div class="col-sm-8">
            <input v-model="lead" type="text" class="form-control" placeholder="Team Lead">
        </div>
        </div> -->
         <div class="form-group row mb-4">
          <label for="staticEmail" class="col-sm-4 col-form-label">Lecturer</label>
            <div>
            <input class="col-sm-4" v-model="lecturer" placeholder="Name" required>
            <input class="col-sm-4" v-model="lecturer_email" placeholder="Email" required>
            <input class="col-sm-3" v-model="lecturer_Pno" placeholder=" P No" required>
            </div>
        </div>

        <div class="form-group row mb-4">
          <label for="staticEmail" class="col-sm-4 col-form-label">University</label>
            <div class="col-sm-8">
             <input v-model="university" type="text" class="form-control" placeholder="University" required>
            </div>
        </div>

       

        <div class="form-group row mb-4">
          <label for="staticEmail" class="col-sm-4 col-form-label">Team Name</label>
            <div class="col-sm-8">
            <input v-model="team_name" type="text" class="form-control" placeholder="Team Name" required>
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
      lecturer_email: "",
      lecturer_Pno: "",
      team_name: "",
      output: "",
      counter: 0,
      
      field0: [],
      field1: [] ,
      field2: [],
      field3: []
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
          lecturer_email : this.lecturer_email,
          lecturer_Pno : this.lecturer_Pno,
          team_name: this.team_name,
          counter: this.counters,
          name: currentObj.field1,
          email: currentObj.field2,
          phone: currentObj.field3
          
        })
        .then(function(response) {
          if (response.data.success) {
            currentObj.output = response.data.message[0];
           currentObj.$router.push('/instructions');
          } else {
            //currentObj.output = response.data.errors;
            console.log(response.data.errors);
          }
        })
        .catch(function(error) {
          currentObj.output = error;
        });
    },
   AddField: function () {
      this.field0.push('');
    },
    removeField(i){
     this.field0.splice(i, 1);
    }
  }
};
</script>
