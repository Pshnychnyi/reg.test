<template>
  <modal
      title="Registration"
      @close="close"
  >
    <template v-slot:body>
      <form @submit.prevent="formHandler">
          <div class="form-item">
              <label for="name">Name</label>
              <input :class="{ error: v$.name.$errors.length }" type="text" id="name" v-model="name">
              <p class="errorText" v-for="error of v$.name.$errors" :key="error.$uid">
                  {{ error.$message }}
              </p>
          </div>
        <div class="form-item">
          <label for="surname">Surname</label>
          <input :class="{ error: v$.surname.$errors.length }" type="text" id="surname" v-model="surname">
          <p class="errorText" v-for="error of v$.surname.$errors" :key="error.$uid">
            {{ error.$message }}
          </p>
        </div>
        <div class="form-item">
          <label for="email">Email</label>
          <input :class="{ error: v$.email.$errors.length }" type="text" id="email" v-model="email">
          <p class="errorText" v-for="error of v$.email.$errors" :key="error.$uid">
            {{ error.$message }}
          </p>
        </div>
        <div class="form-item">
          <label for="password">Password</label>
          <input :class="{ error: v$.pass.$errors.length }" type="password" id="password" v-model="pass">
          <p class="errorText" v-for="error of v$.pass.$errors" :key="error.$uid">
            {{ error.$message }}
          </p>
        </div>
        <div class="form-item">
          <label for="confirm-pass">Confirm password</label>
          <input :class="{ error: v$.pass_confirmation.$errors.length }" type="password" id="confirm-pass" v-model="pass_confirmation">
          <p class="errorText" v-for="error of v$.pass_confirmation.$errors" :key="error.$uid">
            {{ error.$message }}
          </p>
        </div>

        <button class="btn btnPrimary">Registration</button>
      </form>
    </template>
  </modal>
</template>

<script>
import Modal from "../components/ui/Modal.vue";
import { useVuelidate } from '@vuelidate/core'
import {required, minLength, email, sameAs} from '@vuelidate/validators'
import M from "materialize-css";
export default {
  components: {
    Modal
  },
  setup() {
    return{v$: useVuelidate()}
  },
  data() {
    return {
      surname: '',
      name: '',
      email: '',
      pass: '',
      pass_confirmation: ''
    }
  },
  validations () {
    return {
      surname: { required, minLength: minLength(6) },
      name: { required, minLength: minLength(6) },
      email: { required, minLength: minLength(6), email },
      pass: { required, minLength: minLength(6) },
      pass_confirmation: { required, minLength: minLength(6), sameAsPassword: sameAs(this.pass) }
    }
  },
  methods: {

    async formHandler() {
      if(! await this.v$.$validate()) return

      const data = {
        surname: this.surname,
        name: this.name,
        email: this.email,
        pass: this.pass,
        pass_confirmation: this.pass_confirmation,
      }
      axios.post('http://127.0.0.1:8000/api/register', {
          ...data
      }).then(result => {
          if(result.data.status === true) {
              M.toast({html: 'Registration success'})
              this.close()
          }
      }).catch(e => {
          if(e.response.data.status === false) {
              Object.values(e.response.data.errors).forEach(item =>  M.toast({html: item}))
          }
      })



    },
    close() {
      this.surname = ''
      this.name = ''
      this.email = ''
      this.pass = ''
      this.pass_confirmation = ''
      this.v$.$reset()
      this.$emit("close")
    }
  }
}
</script>

<style lang="scss" scoped>

.form-item .errorText {
  font-size: 13.4px;
  color: rgba(193, 0, 0, 1);
}

input.error {
  border: 1px solid rgba(193, 0, 0, 1);
  margin-bottom: 10px;
}

</style>
