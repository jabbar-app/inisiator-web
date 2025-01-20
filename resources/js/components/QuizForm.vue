<template>
  <div>
    <div v-if="errors.length" class="alert alert-danger">
      <strong>Terjadi kesalahan!</strong>
      <ul>
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
    </div>

    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <input type="text" class="form-control" id="name" v-model="form.name" placeholder="Nama Kamu" required />
      </div>
      <div class="mb-3">
        <input type="text" class="form-control" id="phone" v-model="form.phone" placeholder="Nomor WhatsApp" required />
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        phone: '',
      },
      errors: [],
    };
  },
  methods: {
    async submitForm() {
      this.errors = [];
      try {
        const response = await axios.post('/quiz', this.form); // Adjust the route if necessary
        alert('Form berhasil disimpan!');
        this.form.name = '';
        this.form.phone = '';
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = Object.values(error.response.data.errors).flat();
        } else {
          alert('Terjadi kesalahan. Silakan coba lagi.');
        }
      }
    },
  },
};
</script>

<style scoped>
/* Tambahkan styling khusus komponen ini jika diperlukan */
</style>
