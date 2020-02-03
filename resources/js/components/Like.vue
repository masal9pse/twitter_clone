<template>
  <div class="container">
    <button type="button" class="btn btn-danger" @click="submit(postId)">like</button>
  </div>
</template>

<script>
export default {
  props: ["postId"],
  methods: {
    submit(postId) {
      let url = `/api/posts/${postId}/like`;

      axios
        .post(url)
        .then(response => {
          // console.log(url);
        })
        .catch(error => {
          alert(error);
        });
    }
  }
};
</script>
