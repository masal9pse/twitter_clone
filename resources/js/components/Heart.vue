<template>
  <div class="container">
    <button
      v-if="!hearted"
      type="button"
      class="btn p-0 border-0 text-primary"
      @click="heart(postId)"
    >
      <i class="far fa-heart fa-fw"></i>
      <span>{{ heartCount }}</span>
    </button>
    <button v-else type="button" class="btn p-0 border-0 text-danger" @click="unheart(postId)">
      <i class="fas fa-heart fa-fw"></i>
      <span>{{ this.heartCount }}</span>
    </button>
  </div>
</template>

<script>
export default {
  props: ["postId", "userId", "defaultLiked", "defaultCount"],
  data() {
    return {
      hearted: false,
      heartCount: 0
    };
  },
  created() {
    this.hearted = this.defaultLiked;
    this.heartCount = this.defaultCount;
  },
  methods: {
    heart(postId) {
      let url = `/api/posts/${postId}/heart`;

      axios
        .post(url, {
          user_id: this.userId
        })
        .then(response => {
          this.hearted = true; //v-ifのところ
          this.heartCount = response.data.heartCount;
        })
        .catch(error => {
          alert(error);
        });
    },
    unheart(postId) {
      let url = `/api/posts/${postId}/unheart`;

      axios
        .post(url, {
          user_id: this.userId
        })
        .then(response => {
          this.hearted = false;
          // this.heartCount = response.data.heartCount;
          this.heartCount = 0;
        })
        .catch(error => {
          alert(error);
        });
    }
  }
};
</script>
