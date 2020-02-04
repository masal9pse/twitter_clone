<template>
  <div class="container">
    <button v-if="!liked" type="button" class="btn p-0 border-0 text-primary" @click="like(postId)">
      <i class="far fa-heart fa-fw"></i>
      <span>{{ likeCount }}</span>
    </button>
    <button v-else type="button" class="btn p-0 border-0 text-danger" @click="unlike(postId)">
      <i class="fas fa-heart fa-fw"></i>
      <span>{{ likeCount }}</span>
    </button>
  </div>
</template>

<script>
export default {
  props: ["postId", "userId", "defaultLiked", "defaultCount"],
  data() {
    return {
      liked: false,
      likeCount: 0
    };
  },
  created() {
    this.liked = this.defaultLiked;
    this.likeCount = this.defaultCount;
  },
  methods: {
    like(postId) {
      let url = `/api/posts/${postId}/like`;

      axios
        .post(url, {
          user_id: this.userId
        })
        .then(response => {
          this.liked = true; //v-ifのところ
          this.likeCount = response.data.likeCount;
        })
        .catch(error => {
          alert(error);
        });
    },
    unlike(postId) {
      let url = `/api/posts/${postId}/unlike`;

      axios
        .post(url, {
          user_id: this.userId
        })
        .then(response => {
          this.liked = false;
          this.likeCount = response.data.likeCount;
        })
        .catch(error => {
          alert(error);
        });
    }
  }
};
</script>
