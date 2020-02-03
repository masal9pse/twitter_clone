<template>
  <div class="container">
    <button v-if="!liked" type="button" class="btn btn-success" @click="submit(postId)">like</button>
    <button v-else type="button" class="btn btn-success" @click="submit(postId)">liked</button>
  </div>
</template>

<script>
export default {
  props: ["postId", "userId", "defaultLiked"],
  data() {
    return {
      liked: false
    };
  },
  created() {
    this.liked = this.defaultLiked;
  },
  methods: {
    submit(postId) {
      let url = `/api/posts/${postId}/like`;

      axios
        .post(url, {
          user_id: this.userId
        })
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
