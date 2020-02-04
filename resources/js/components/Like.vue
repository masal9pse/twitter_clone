<template>
  <div class="container">
    <button v-if="!liked" type="button" class="btn btn-success" @click="like(postId)">like</button>
    <button v-else type="button" class="btn btn-success" @click="like(postId)">liked</button>
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
    like(postId) {
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
