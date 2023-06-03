<template>
  <div>
    <button 
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
      @click="followUser"
      v-text="buttonText"
    >
    </button>
  </div>
</template>

<script>
  export default {
    props: ['userId', 'follows'],
    mounted() {
      console.log("Component mounted.");
    },
    data: function() {
      return {
        status: this.follows,
      }
    },
    methods: {
      followUser() {
        // alert('Hello');
        axios.post('/follow/' + this.userId)
          .then(response => {
            this.status = !this.status;
            console.log(response.data);
          })
          .catch(errors => {
            if (errors.response.status == 401) {
              window.location = '/login';
            }
          });
      }
    },
    computed: {
      buttonText() {
        return (this.status) ? 'Unfollow' : 'Follow';
      }
    }
  }
</script>

